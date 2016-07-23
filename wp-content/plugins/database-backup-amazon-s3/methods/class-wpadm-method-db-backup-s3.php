<?php
/**
 * Class WPadm_Db_Method_Backup
 */
if (!class_exists('WPadm_Method_Db_Backup_S3')) {
    class WPadm_Method_Db_Backup_S3 extends WPAdm_Method_Class {
        /**
         * @var String
         */
        private $id;
    
        /**
         * Unixtimestamp, start time
         * @var Int
         */
        private $stime;
    
        /**
         * @var WPAdm_Queue
         */
        private $queue;
    
        /**
         * @var string
         */
        private $dir;
    
        /**
         * @var string
         */
        private $tmp_dir;
    
        /**
         * @var string
         */
        private $type = 'db';
    
        private $name = '';
    
        public function __construct($params) {
            parent::__construct($params);
            $this->init(
                array(
                    'id' => uniqid('wpadm_method_backup__'),
                    'stime' => time(),
                    'type' => $params['type'],
                )
            );
    
    
    
            $name = get_option('siteurl');
    
            $name = str_replace("http://", '', $name);
            $name = str_replace("https://", '', $name);
            $name = preg_replace("|\W|", "_", $name);
            $name .= '-db-' . date("Y_m_d_H_i");
            $this->name = $name;
    
            $this->dir = ABSPATH . 'wpadm_backups/' . $this->name;
            WPAdm_Core::mkdir(ABSPATH . 'wpadm_backups/');
            WPAdm_Core::mkdir($this->dir);
        }
    
        public function getResult()
        {
            $errors = array();
    
            $this->result->setResult(WPAdm_Result::WPADM_RESULT_SUCCESS);
            $this->result->setError('');
    
            WPAdm_Core::log('Start backup');
    
            WPAdm_Core::mkdir(ABSPATH . 'wpadm_backup');
            $mysql_dump_file = ABSPATH . 'wpadm_backup/mysqldump.sql';
            if (file_exists($mysql_dump_file)) {
                unlink($mysql_dump_file);
            }
            $wp_mysql_params = $this->getWpMysqlParams();
    
            if (isset($this->params['optimize']) && ($this->params['optimize']==1)) {
                WPAdm_Core::log('Optimize database tables');
                $commandContext = new WPAdm_Command_Context();
                $commandContext ->addParam('command','mysqloptimize')
                    ->addParam('host', $wp_mysql_params['host'])
                    ->addParam('db', $wp_mysql_params['db'])
                    ->addParam('user', $wp_mysql_params['user'])
                    ->addParam('password', $wp_mysql_params['password']);
                $this->queue->clear()
                            ->add($commandContext);
                unset($commandContext);
            }
    
            $commandContext = new WPAdm_Command_Context();
            $commandContext ->addParam('command','mysqldump')
                            ->addParam('host', $wp_mysql_params['host'])
                            ->addParam('db', $wp_mysql_params['db'])
                            ->addParam('user', $wp_mysql_params['user'])
                            ->addParam('password', $wp_mysql_params['password'])
                            ->addParam('tables', '')
                            ->addParam('to_file', $mysql_dump_file);
            $res = $this->queue->add($commandContext)
                                ->save()
                                ->execute();
    
            if (!$res) {
                WPAdm_Core::log('Database dump was not created('.$this->queue->getError().')');
                $errors[] = 'MySQL error: '.$this->queue->getError();
            } elseif (0 == (int)filesize($mysql_dump_file)) {
                $errors[] = 'MySQL error: empty dump-file';
                WPAdm_Core::log('Database dump was not created(empty file)');
            } else {
                WPAdm_Core::log('Database dump created('.filesize($mysql_dump_file).'b):' . $mysql_dump_file);
            }
            unset($commandContext);
    
    
            WPAdm_Core::log('Start preparing a list of files');
            $files = array();
            if (file_exists($mysql_dump_file) && filesize($mysql_dump_file) > 0) {
                $files[] = $mysql_dump_file;
            }
    
            if (empty($files)) {
                $errors[] = 'Empty list files';
            }

            // Divide the list of files on the lists from 170 kbytes to break one big task into smaller            
            $files2 = array();
            $files2[0] = array();
            $i = 0;
            $size = 0;
            foreach($files as $f) {
                if ($size > 170000) {//~170kbyte
                    $i ++;
                    $size = 0;
                    $files2[$i] = array();
                }
                $f_size =(int)filesize($f);
                if ($f_size == 0 || $f_size > 1000000) {
                    WPAdm_Core::log('file '. $f .' size ' . $f_size);
                }
                $size += $f_size;
                $files2[$i][] = $f;
            }
    
            WPAdm_Core::log('List of files prepared');
            $this->queue->clear();
    
            foreach($files2 as $files) {
                $commandContext = new WPAdm_Command_Context();
                $commandContext ->addParam('command','archive')
                    ->addParam('files', $files)
                    ->addParam('to_file', $this->dir . '/'.$this->name)
                    ->addParam('max_file_size', 900000)
                    ->addParam('remove_path', ABSPATH);
    
                $this->queue->add($commandContext);
                unset($commandContext);
            }
            WPAdm_Core::log('Getting back up files');
            $this->queue->save()
                        ->execute();
            WPAdm_Core::log('Ended up files');
    
            $files = glob($this->dir . '/' . $this->name . '*');
            $urls = array();
            $totalSize = 0;
            foreach($files as $file) {
                $urls[] = str_replace(ABSPATH, '', $file);
                $totalSize += @intval( filesize($file) );
            }
            $this->result->setData($urls);
            $this->result->setSize($totalSize);

            $remove_from_server = 0;
            if (isset($this->params['storage'])) {
                foreach($this->params['storage'] as $storage) {
                    if ($storage['type'] == 's3') {
                        WPAdm_Core::log('Begin coping files to S3');
                        $this->queue->clear();
                        $files = glob($this->dir . '/'.$this->name . '*');
                        //$this->getResult()->setData($files);
                        $ad = $storage['access_details'];
                        $dir = (isset($ad['dir'])) ? $ad['dir'] : '/';
                        $dir = trim($dir, '/') . '/' . $this->name;
                        foreach($files as $file) {
                            $commandContext = new WPAdm_Command_Context();
                            $commandContext ->addParam('command','send_to_s3')
                                ->addParam('file', $file)
                                ->addParam('bucket', $ad['bucket'])
                                ->addParam('AccessKeyId', $ad['AccessKeyId'])
                                ->addParam('SecretAccessKey', $ad['SecretAccessKey'])
                                ->addParam('SessionToken', $ad['SessionToken']);
                            if (isset($ad['mkdir_for_backup']) && $ad['mkdir_for_backup'] == 1) {
                                $commandContext->addParam('dir', $this->name);
                            }
                            $this->queue->add($commandContext);
                            unset($commandContext);
                        }
                        $res = $this->queue->save()
                            ->execute();
                        if (!$res) {
                            WPAdm_Core::log('S3: ' . $this->queue->getError());
                            $errors[] = 'S3: '.$this->queue->getError();
                        }
                        WPAdm_Core::log('Finished copying files to S3');
                        if (isset($storage['remove_from_server']) && $storage['remove_from_server'] == 1 ) {
                            $remove_from_server = $storage['remove_from_server'];
                        }
                    }
                }
                if ($remove_from_server) {
                    // удаляем файлы на сервере
                    WPAdm_Core::log('Remove the backup server');
                    WPAdm_Core::rmdir($this->dir);
                }

            }
    
            # delete tmpf-files
            WPAdm_Core::rmdir(ABSPATH . 'wpadm_backup');
    
            #Remove old archives (over limit)
            WPAdm_Core::log('Start removing old files');
            if ($this->params['limit'] != 0) {
                $files = glob(ABSPATH . 'wpadm_backups/*');
                if (count($files) > $this->params['limit']) {
                    $files2 = array();
                    foreach($files as $f) {
                        $fa = explode('-', $f);
                        if (count($fa) != 3) {
                            continue;
                        }
                        $files2[$fa[2]] = $f;
    
                    }
                    ksort($files2);
                    $d = count($files2) - $this->params['limit'];
                    $del = array_slice($files2, 0, $d);
                    foreach($del as $d) {
                        WPAdm_Core::rmdir($d);
                    }
                }
            }
            WPAdm_Core::log('Finished delete the old files');
    
            WPAdm_Core::log('backup completed');
    
            if (!empty($errors)) {
                $this->result->setError(implode("\n", $errors));
                $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
            }
            return $this->result;
        }

        /*
         * Take account access data from MySQL parameters WP
         * return Array()
         */
        private function getWpMysqlParams()
        {
            $db_params = array(
                'password' => 'DB_PASSWORD',
                'db' => 'DB_NAME',
                'user' => 'DB_USER',
                'host' => 'DB_HOST',
            );
    
            $r = "/define\('(.*)', '(.*)'\)/";
            preg_match_all($r, file_get_contents(ABSPATH . "wp-config.php"), $m);
            $params = array_combine($m[1], $m[2]);
            foreach($db_params as $k=>$p) {
                $db_params[$k] = $params[$p];
            }
            return $db_params;
        }
    
    
        private function init(array $conf) {
            $this->id = $conf['id'];
            $this->stime = $conf['stime'];
            $this->queue = new WPAdm_Queue($this->id);
            $this->type = $conf['type'];
        }
    }
}