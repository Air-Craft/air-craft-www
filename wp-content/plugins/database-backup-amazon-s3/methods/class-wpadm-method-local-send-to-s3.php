<?php
/**
 * Бэкап сайта
 * Class WPadm_Method_Send_To_S3
 */
if (!class_exists('WPadm_Method_Local_Send_To_S3')) {
    class WPadm_Method_Local_Send_To_S3 extends WPAdm_Method_Class {
        /**
         * @var WPAdm_Queue
         */
        private $queue;

        private $id;

        //private $name = '';

        public function getResult()
        {
            $errors = array();
            $this->id = uniqid('wpadm_method_local_send_to_s3_');

            $this->result->setResult(WPAdm_Result::WPADM_RESULT_SUCCESS);
            $this->result->setError('');

            $this->queue = new WPAdm_Queue($this->id);

            WPAdm_Core::log('Start copy files to Amazon S3');
            $this->queue->clear();
            $files = $this->params['files'];
            //$this->getResult()->setData($files);

            $dir = (isset($ad['dir'])) ? $ad['dir'] : '/';
            //$dir = trim($dir, '/') . '/' . $this->name;
            foreach($files as $file) {
                $commandContext = new WPAdm_Command_Context();
                $commandContext ->addParam('command','local_send_to_s3')
                    ->addParam('file', ABSPATH . $file)
                    ->addParam('bucket', $this->params['bucket'])
                    ->addParam('AccessKeyId', $this->params['AccessKeyId'])
                    ->addParam('SecretAccessKey', $this->params['SecretAccessKey']);
                if (isset($this->params['dir']) && !empty($this->params['dir'])) {
                    $commandContext->addParam('dir', $this->params['dir']);
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
            WPAdm_Core::log('End copy files to Amazon S3');
            if (!empty($errors)) {
                $this->result->setError(implode("\n", $errors));
                $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
            }

            return $this->result;
        }
    }
}