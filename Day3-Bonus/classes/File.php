<?php

use Aws\s3\S3Client;
use Aws\s3\Exception\S3Exception;

class File
{
    private $_msg;
    private $_s3;
    public function __construct()
    {
        if (!empty($_FILES)) {
            $is_valid =   $this->is_valid_file();
            $this->show_msg();
            if ($is_valid) {
                $this->upload_file();
                $this->show_msg();
            }
        }
    }

    public function is_valid_file()
    {
        if ($_FILES["fileToUpload"]["size"] > 3000000) {

            $this->_msg = "file size is too large";
            return false;
        } elseif (!stristr($_FILES["fileToUpload"]["type"], "image")) {
            $this->_msg = "file type must be image";
            return false;
        } else {
            $this->_msg = "correct file";
            return true;
        }
    }


    public function upload_file()
    {
        $this->set_connection();
        try {
            $id = uniqid();
            $file = $_FILES["fileToUpload"]['tmp_name'];
            $this->_s3->putObject(
                array(
                    'Bucket' => 'mariamk-s3',
                    'Key' =>  $id,
                    'SourceFile' => $file,
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                )
            );
        } catch (Aws\S3\Exception\S3Exception $e) {

            $this->_msg = "There is an error in upload";
        }
    }
    private function set_connection()
    {
        $this->_s3 = S3Client::factory(array(
            'credentials' => array(
                'key' => _ACCESS_KEY_,
                'secret' => _SECRET_ACCESS_KEY_,

            ), 'region' => 'us-east-1',
            'version' => 'latest'
        ),);
    }
    public function show_msg()
    {
        echo "<p>$this->_msg </p>";
    }
}
