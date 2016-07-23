<?php
if (!class_exists('WPadm_Command_Local_Send_To_S3')) {
    class WPadm_Command_Local_Send_To_S3 extends WPAdm_Сommand {

        public function execute(WPAdm_Command_Context $context)
        {
            require_once WPAdm_Core::getPluginDir() . '/modules/aws-autoloader.php';
            $credentials = new Aws\Common\Credentials\Credentials($context->get('AccessKeyId'), $context->get('SecretAccessKey'));
            $client = Aws\S3\S3Client::factory(array( 'credentials' => $credentials ) );


            $dir = ($context->get('dir')) ? $context->get('dir') . "/" : '';
            try {  
                if (!empty($dir)) {
                    $logs = $client->putObject(array('Bucket' => $context->get('bucket'), 'Key' => $dir, 'Body' => ''));
                    WPAdm_Core::log('Create folder ' . $dir);
                }


                $filePath = preg_replace('#[/\\\\]+#', '/', $context->get('file'));
                $key = ($dir) ? $dir .'/'. basename($filePath) : basename($filePath);
                $key = ltrim( preg_replace('#[/\\\\]+#', '/', $key), '/' );//if first will be '/', file not will be uploaded, but result will be ok

                $putRes = $client->putObject(array("Bucket" => $context->get('bucket'), 'Key' => $key, 'Body' => fopen($filePath, 'r+')));
                if ((int)$putRes == 1) {
                    WPAdm_Core::log("File($key) Upload successfully to Amazon S3");
                }
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
