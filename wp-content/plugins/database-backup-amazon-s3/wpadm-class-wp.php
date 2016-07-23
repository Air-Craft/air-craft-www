<?php 
    if (! defined("WPADM_URL_BASE")) {
        define("WPADM_URL_BASE", 'http://secure.webpage-backup.com/');
    }

    if(session_id() == '') {
        session_start();
    }

    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "libs/error.class.php";
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "libs/wpadm.server.main.class.php";
    if (! class_exists("wpadm_wp_db_backup_s3") ) {
        // ajax actions
        add_action('wp_ajax_wpadm_db_s3_local_restore', array('wpadm_wp_db_backup_s3', 'restore_backup') );
        add_action('wp_ajax_wpadm_db_s3_logs', array('wpadm_wp_db_backup_s3', 'getLog') );
        add_action('wp_ajax_wpadm_db_s3_local_backup', array('wpadm_wp_db_backup_s3', 'local_backup') );
        add_action('wp_ajax_wpadm_db_s3_backup', array('wpadm_wp_db_backup_s3', 'backup_s3') );
        add_action('wp_ajax_set_user_mail', array('wpadm_wp_db_backup_s3', 'setUserMail') );
        // post actions
        add_action('admin_post_wpadm_db_s3_delete_backup', array('wpadm_wp_db_backup_s3', 'delete_backup') );
        // init actions
        add_action('init', array('wpadm_wp_db_backup_s3', 'init') );

        class wpadm_wp_db_backup_s3 extends wpadm_class  {

            const MIN_PASSWORD = 6;
            
            /**
            * initialize plugin name for plugin
            * 
            */
            public static function init()
            {
                parent::$plugin_name = 'database-backup-amazon-s3';
            }

            public static function setUserMail()
            {
                if (isset($_POST['email'])) {
                    $email = trim($_POST['email']);
                    $mail = get_option(PREFIX_BACKUP_ . "email");
                    if ($mail) {
                        add_option(PREFIX_BACKUP_ . "email", $email);
                    } else {
                        update_option(PREFIX_BACKUP_ . "email",$email);
                    }
                } 
                echo 'true';
                wp_die();
            }

            public static function local_backup()
            {
                require_once dirname(__FILE__) . "/class-wpadm-core.php";
                @session_write_close();
                parent::$type = 'db';
                if (file_exists(WPAdm_Core::getTmpDir() . "/logs2")) {
                    unlink(WPAdm_Core::getTmpDir() . "/logs2");
                }
                $backup = new WPAdm_Core(array('method' => "local_backup", 'params' => array('optimize' => 1, 'limit' => 0, 'types' => array('db') )), 'db_backup_s3', dirname(__FILE__));
                $res = $backup->getResult()->toArray();
                $res['md5_data'] = md5( print_r($res, 1) );
                $res['name'] = $backup->name;
                $res['time'] = $backup->time;
                $res['type'] = 'local';
                $res['counts'] = count($res['data']);
                @session_start();
                echo json_encode($res);
                wp_die();

            }
            public static function backup_s3()
            {
                @session_write_close();
                date_default_timezone_set("Europe/Moscow");
                parent::$type = 'db';
                $amazon_option = self::getAmazonOptions();
                if ($amazon_option) {
                    $send_data = true;
                    if (isset($amazon_option['access_key_id']) && empty($amazon_option['access_key_id'])) {
                        $res['error'] = 'Error: "Access Key ID" is not exist for send backup files to Amazon S3. Please type your "Access Key ID" in the Settings form.';
                        $res['result'] = 'error';
                        $send_data = false;
                    }
                    if (isset($amazon_option['secret_access_key']) && empty($amazon_option['secret_access_key'])) {
                        $res['error'] = 'Error: "Secret Access Key" is not exist for send backup files to Amazon S3. Please type your "Secret Access Key" in the Settings form.';
                        $res['result'] = 'error';
                        $send_data = false;
                    }
                    if (isset($amazon_option['bucket']) && empty($amazon_option['bucket'])) {
                        $res['error'] = 'Error: "Bucket" is not exist for send backup files to Amazon S3. Please type your "Bucket" in the Settings form.';
                        $res['result'] = 'error';
                        $send_data = false;
                    }
                    if ($send_data) {
                        require_once dirname(__FILE__) . "/class-wpadm-core.php";

                        if (file_exists(WPAdm_Core::getTmpDir() . "/logs2")) {
                            unlink(WPAdm_Core::getTmpDir() . "/logs2");
                        }
                        $backup = new WPAdm_Core(array('method' => "local_backup", 'params' => array('optimize' => 1, 'limit' => 0, 'types' => array('db') )), 'db_backup_s3', dirname(__FILE__));
                        $res = $backup->getResult()->toArray();
                        $res['md5_data'] = md5( print_r($res, 1) );
                        $res['name'] = $backup->name;
                        $res['time'] = $backup->time;
                        $res['type'] = 's3';
                        $res['counts'] = count($res['data']);
                        $send = new WPAdm_Core(array('method' => "local_send_to_s3", 
                        'params' => array( 'bucket' => $amazon_option['bucket'], 
                        'AccessKeyId' => $amazon_option['access_key_id'], 
                        'SecretAccessKey' => $amazon_option['secret_access_key'], 
                        'dir' => $res['name'], 
                        'files' => $res['data']  
                        )
                        ), 
                        'db_backup_s3', dirname(__FILE__));
                        $res2 = $send->getResult()->toArray();
                        WPADM_core::rmdir(ABSPATH . "wpadm_backups/{$res['name']}");
                        if ($res2['result'] == 'error') { 
                            $res = $res2;
                        }
                    }
                } else {
                    $res['error'] = 'Error: Data is not exist for send backup files to Amazon S3. Please type your Data in the Settings form';
                    $res['result'] = 'error';
                }
                @session_start();
                echo json_encode($res);
                wp_die();
            }
            public static function getLog()
            {   
                @session_write_close();
                @session_start();
                require_once dirname(__FILE__) . "/class-wpadm-core.php";
                $backup = new WPAdm_Core(array('method' => "local"), 'db_backup_s3', dirname(__FILE__));
                $log = WPAdm_Core::getLog();
                $log2 = WPAdm_Core::getTmpDir() . "/logs2";
                if (file_exists($log2)) {
                    $text = file_get_contents($log2);
                    $log = str_replace($text, "", $log);
                    file_put_contents($log2, $log); 
                } else {
                    file_put_contents($log2, $log);
                }
                $log = explode("\n", $log);
                krsort($log);
                echo json_encode(array('log' => $log));
                exit;
            }
            public static function restore_backup()
            {

                require_once dirname(__FILE__) . "/class-wpadm-core.php";
                @session_write_close();
                $log = new WPAdm_Core(array('method' => "local"), 'db_backup_s3', dirname(__FILE__) );
                if (file_exists(WPAdm_Core::getTmpDir() . "/logs2")) {
                    unlink(WPAdm_Core::getTmpDir() . "/logs2");
                }
                if (file_exists(WPAdm_Core::getTmpDir() . "/log.log")) {
                    unlink(WPAdm_Core::getTmpDir() . "/log.log");
                }
                $res['error'] = 'Error';
                $res['result'] = 'error';
                parent::$type = 'db';
                if (isset($_POST['type'])) {
                    $name_backup = isset($_POST['name']) ? trim($_POST['name']) : ""; 
                    $dir = ABSPATH . 'wpadm_backups/' .  $name_backup;
                    if ($_POST['type'] == 'local') {
                        $backup = new WPAdm_Core(array('method' => "local_restore", 'params' => array('types' => array('db'), 'name_backup' => $name_backup )), 'db_backup_s3', dirname(__FILE__));
                        $res = $backup->getResult()->toArray();
                    } elseif ($_POST['type'] == 's3') {
                        $amazon_option = self::getAmazonOptions();
                        if ($amazon_option) {
                            require_once dirname(__FILE__) . '/modules/aws-autoloader.php';
                            try {
                                $credentials = new Aws\Common\Credentials\Credentials($amazon_option['access_key_id'], $amazon_option['secret_access_key']);
                                $client = Aws\S3\S3Client::factory(array( 'credentials' => $credentials ) );
                                $project = self::getNameProject();
                                WPAdm_Core::log("Get Files for Resore Backup");
                                $keys = $client->listObjects(array('Bucket' => $amazon_option['bucket'], 'Prefix' => $name_backup ))->getIterator();//->getPath('Contents/*/Key');
                                if (isset($keys['Contents'])) {
                                    $n = count($keys['Contents']);
                                    WPAdm_Core::mkdir($dir);
                                    WPAdm_Core::log("Start Downloads files with Amazon S3");
                                    for($i = 0; $i < $n; $i++) {
                                        $path = explode("/", $keys['Contents'][$i]['Key']);
                                        if(isset($path[0]) && isset($path[1]) && !empty($path[1])) {
                                            $result = $client->getObject(array(
                                            'Bucket' => $amazon_option['bucket'],
                                            'Key'    => $keys['Contents'][$i]['Key'],
                                            'SaveAs' => ABSPATH . 'wpadm_backups/' . $keys['Contents'][$i]['Key']
                                            ));
                                            WPAdm_Core::log("Download file - {$keys['Contents'][$i]['Key'] }");
                                        }
                                    }
                                    WPAdm_Core::log("End downloads files with Amazon S3");

                                    $restore= new WPAdm_Core(array('method' => "local_restore", 'params' => array('log-delete' => 0,  'types' => array('db'), 'name_backup' => $name_backup )), 'db_backup_s3', dirname(__FILE__));
                                    $res = $restore->getResult()->toArray();
                                    if (is_dir($dir)) {
                                        WPAdm_Core::rmdir($dir);
                                    }
                                } else {
                                    $res['error'] = "Error, in downloads with Amazon S3";
                                    $res['result'] = 'error';
                                }

                            } catch (Exception $e) {
                                $res['error'] = $e->getMessage();
                                $res['result'] = 'error';
                            } catch(S3Exception $e) {
                                $res['error'] = $e->getMessage();
                                $res['result'] = 'error'; 
                            }
                        } else {
                            $res['error'] = 'Error: Data is not exist for send backup files to Amazon S3. Please type your Data in the Settings form';
                            $res['result'] = 'error';
                        }
                    }
                }

                @session_start();

                echo json_encode($res);
                wp_die();
            }  

            public static function delete_backup()
            {
                if (isset($_POST['backup-type'])) {
                    if ($_POST['backup-type'] == 'local') {
                        require_once dirname(__FILE__) . "/class-wpadm-core.php";
                        $dir = ABSPATH . 'wpadm_backups/' . $_POST['backup-name'] ;
                        if (is_dir($dir)) {
                            WPAdm_Core::rmdir($dir);
                        }
                    } elseif($_POST['backup-type'] == 's3') {
                        $amazon_option = self::getAmazonOptions();
                        if ($amazon_option) {
                            require_once dirname(__FILE__) . '/modules/aws-autoloader.php';
                            $credentials = new Aws\Common\Credentials\Credentials($amazon_option['access_key_id'], $amazon_option['secret_access_key']);
                            $client = Aws\S3\S3Client::factory(array( 'credentials' => $credentials ) );
                            try {
                                $keys = $client->listObjects(array('Bucket' => $amazon_option['bucket'], 'Prefix' => $_POST['backup-name']))->getIterator();
                                if (isset($keys['Contents'])) {
                                    $n = count($keys['Contents']);
                                    for($i = 0; $i < $n; $i++) {
                                        $client->deleteObject(array('Bucket' => $amazon_option['bucket'], 'Key' => $keys['Contents'][$i]['Key']));
                                    }
                                }
                            } catch (Exception $e) {
                                $_SESSION['errorMsgWpadmDB'] = $e->getMessage();
                            } catch(S3Exception $e) {
                                $_SESSION['errorMsgWpadmDB'] = $e->getMessage();
                            }
                        }
                    }
                }
                header("Location: " . admin_url("admin.php?page=wpadm_wp_db_backup_s3"));
            }

            protected static function getPluginName()
            {

                preg_match("|wpadm_wp_(.*)|", __CLASS__, $m);
                return $m[1];
            }
            protected static function getPathPlugin()
            {
                return "wpadm_db_backup_s3";
            }
           


            public static function wpadm_show_backup()
            {
                if (isset($_POST['access_key_id']) && isset($_POST['secret_access_key']) && isset($_POST['bucket'])) {
                    $bucket = trim($_POST['bucket']);
                    $access_key_id = stripslashes( trim($_POST['access_key_id']) );
                    $secret_access_key = stripslashes( trim($_POST['secret_access_key']) );
                    $bucketLen = strlen($bucket);
                    $error = array();
                    if ($bucketLen < 3 || $bucketLen > 63 ||
                    // Cannot look like an IP address
                    preg_match('/(\d+\.){3}\d+$/', $bucket) ||
                    // Cannot include special characters, must start and end with lower alnum
                    !preg_match('/^[a-z0-9]([a-z0-9\-\.]*[a-z0-9])?$/', $bucket)
                    ) {
                        $_SESSION['errorMsgWpadmDB'] = 'Incorrect Bucket Name';
                    }
                    if (!isset($_SESSION['errorMsgWpadmDB']))  {
                        self::setAmazonOption($access_key_id, $secret_access_key, $bucket);
                    } 
                }
                parent::$type = 'db';
                $amazon_option = self::getAmazonOptions();
                if ($amazon_option) {
                    $data = self::getBackupsInAmazon($amazon_option);
                }
               
                require_once dirname(__FILE__) . "/class-wpadm-core.php";
                $data_local = parent::read_backups();
                if (isset($data['data'])) {
                    $data['data'] = array_merge($data_local['data'], $data['data']);
                    $data['md5'] = md5( print_r( $data['data'] , 1 ) );
                } else {
                    $data = $data_local;
                }
                $error = parent::getError(true);
                $show = !get_option('wpadm_pub_key') && is_super_admin();
                $msg = parent::getMessage(true); 

                ob_start();
                require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "template/wpadm_show_backup.php";
                echo ob_get_clean();

            }
            public static function getNameProject()
            {
                $folder_project = str_ireplace( array("http://", "https://"), '', home_url() );
                $folder_project = str_ireplace( array( "-", '/', '.'), '_', $folder_project );
                return $folder_project;
            }
            public static function getBackupsInAmazon($setting)
            {
                require_once dirname(__FILE__) . '/modules/aws-autoloader.php';
                $credentials = new Aws\Common\Credentials\Credentials($setting['access_key_id'], $setting['secret_access_key']);
                $client = Aws\S3\S3Client::factory(array( 'credentials' => $credentials ) );
                $data = array('data' => array(), 'md5' => md5( print_r(array(), 1) ) );
                try {
                    $project = self::getNameProject();
                    $keys = $client->listObjects(array('Bucket' => $setting['bucket'], 'Prefix' => $project . '-db'))->getIterator();//->getPath('Contents/*/Key');
                    if (isset($keys['Contents'])) {
                        $n = count($keys['Contents']);
                        $j = 0;
                        $backups = array();
                        for($i = 0; $i < $n; $i++) {
                            if (isset($keys['Contents'][$i]['Key'])) {
                                $backup = explode('/', $keys['Contents'][$i]['Key']);
                                if (isset($backup[0]) && isset($backup[1]) && !empty($backup[1])) {
                                    if (!isset($backups[$backup[0]])) {
                                        $backups[$backup[0]] = $j;
                                        $data['data'][$j]['name'] = $backup[0];
                                        $data['data'][$j]['dt'] = parent::getDateInName($backup[0]);
                                        $data['data'][$j]['size'] = $keys['Contents'][$i]['Size'];
                                        $data['data'][$j]['files'] = $backup[1];
                                        $data['data'][$j]['type'] = 's3';
                                        $data['data'][$j]['count'] = 1;
                                        $j++;
                                    } else {
                                        $data['data'][$backups[$backup[0]]]['files'] .= ',' . $backup[1];
                                        $data['data'][$backups[$backup[0]]]['size'] += $keys['Contents'][$i]['Size'];
                                        $data['data'][$backups[$backup[0]]]['count'] += 1;
                                    }
                                }
                            }

                        }
                    }
                } catch (\Aws\S3\Exception\S3Exception $e) {
                    return $data;
                }
                return $data;
            }

            public static function getAmazonOptions()
            {
                $amazon_options = get_option(PREFIX_BACKUP_ . 'amazon-s3-setting');
                if ($amazon_options) {
                    $amazon_options = unserialize( base64_decode( $amazon_options ) );
                }
                return $amazon_options; 
            }
            public static function setAmazonOption($access_key_id, $secret_access_key, $bucket)
            {
                $new = array();
                $new['access_key_id'] = $access_key_id;
                $new['secret_access_key'] = $secret_access_key;
                $new['bucket'] = $bucket;
                $new_option = base64_encode( serialize( $new ) );
                $options = self::getAmazonOptions();
                if ($options) {
                    update_option(PREFIX_BACKUP_ . 'amazon-s3-setting', $new_option);
                } else {
                    add_option(PREFIX_BACKUP_ . 'amazon-s3-setting', $new_option);
                }
            }
            public static function getProjectName()
            {
                $site = home_url();
                $folder_project = str_ireplace( array("http://", "https://"), '', $site );
                $folder_project = str_ireplace( array( "-", '/', '.'), '_', $folder_project );
                return $folder_project;
            }

            public static function draw_menu()
            {
                $menu_position = '1.9998887771'; 
                parent::$plugin_name = 'database-backup-amazon-s3';
                if(parent::checkInstallWpadmPlugins()) {
                    $page = add_menu_page(
                    'WPAdm', 
                    'WPAdm', 
                    "read", 
                    'wpadm_plugins', 
                    'wpadm_plugins',
                    plugins_url('/wpadm-logo.png', __FILE__),
                    $menu_position     
                    );
                    add_submenu_page(
                    'wpadm_plugins', 
                    "Amazon S3 Database Backup",
                    "Amazon S3 Database Backup",
                    'read',
                    'wpadm_wp_db_backup_s3',
                    array('wpadm_wp_db_backup_s3', 'wpadm_show_backup')
                    );
                } else {
                    add_submenu_page("wpadm_wp_db_backup_s3", "Database backup", "Database backup", "read", "wpadm_wp_db_backup_s3", array('wpadm_wp_db_backup_s3', 'wpadm_show_backup'));
                    $page = add_menu_page(
                    'Amazon S3 Backup', 
                    'Amazon S3 Backup', 
                    "read", 
                    'wpadm_wp_db_backup_s3', 
                    array('wpadm_wp_db_backup_s3', 'wpadm_show_backup'),
                    plugins_url('/wpadm-logo.png', __FILE__),
                    $menu_position     
                    );

                    add_submenu_page(
                    'wpadm_wp_db_backup_s3', 
                    "WPAdm",
                    "WPAdm",
                    'read',
                    'wpadm_plugins',
                    'wpadm_plugins'
                    );
                }
            }
        }
    }

?>
