<?php
if (!class_exists('WPadm_Command_Send_To_S3')) {
    class WPadm_Command_Send_To_S3 extends WPAdm_Сommand {

        public function execute(WPAdm_Command_Context $context)
        {
            require_once WPAdm_Core::getPluginDir() . '/modules/S3.php';

            $s3 = new S3($context->get('AccessKeyId'), $context->get('SecretAccessKey'));
            //new S3Wrapper();
            //S3::setAuth($context->get('AccessKeyId'), $context->get('SecretAccessKey'));
            /*(array(
            'key'    => $context->get('AccessKeyId'),
            'secret' => $context->get('SecretAccessKey'),
            'token'  => $context->get('SessionToken')
            ));   */
            
           // $s3->setTimeCorrectionOffset(60);

            $dir = ($context->get('dir')) ? $context->get('dir') : '';

            if ($dir) {

                //$s3->mkdir('s3://' . $context->get('bucket') . '/' . $dir);
                $logs = $s3->putObject($dir, $context->get('bucket'), $dir . "/", s3::ACL_PUBLIC_READ);
                //$logs = $s3->putObjectString($dir, $context->get('bucket'), $context->get('bucket') . '/' . $dir, s3::ACL_PUBLIC_READ_WRITE);
                WPAdm_Core::log('create folder logs ' . serialize($logs));
                /*$s3->registerStreamWrapper("s3");
                @mkdir('s3://'.$context->get('bucket').'/'.$dir);*/
            }


            try {
                $filePath = preg_replace('#[/\\\\]+#', '/', $context->get('file'));
                $key = ($dir) ? $dir .'/'. basename($filePath) : basename($filePath);
                $key = ltrim( preg_replace('#[/\\\\]+#', '/', $key), '/' );//if first will be '/', file not will be uploaded, but result will be ok

                
                $putRes = $s3->putObjectFile($filePath, $context->get('bucket'), $key, s3::ACL_PUBLIC_READ_WRITE);

                WPAdm_Core::log('putObjectFile ' . $filePath . ' == ' . $context->get('bucket') . " == " . $key . ' == '.(int)$putRes);
            } catch (Exception $e) {
                $context->setError($e->getMessage());
                return false;
            } catch(S3Exception $e) {
                WPAdm_Core::log('error send file ' . $e->getMessage());
                $context->setError($e->getMessage());
                return false;
            }
            return true;
        }
    }
}