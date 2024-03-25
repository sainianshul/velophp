<?php

namespace App\Core\Upload;

class Upload{

    private $file_input = null;
    private $max_size = 0;
    private $allow_format = [];
    private $destination = null;
    public $file_errors = [];
    private $upload_path = null;
    private $file = [];
    private $req = null;



     


    public function file($file) {
        $this->file_input = $file;
        return $this;
    }
    

    public function max($max_size = 0) {
        $this->max_size = $max_size;
        return $this;
    }

    public function allow($format = []) {
        $this->allow_format = $format;
        return $this;
    }

    public function destination($destination = '') {

        $this->destination = $destination;
        return $this;
    }

   public function save() {
    $data['isUpload'] = false;
    $data['error'] = null;
    $data['upload_path'] = null;

    if (!isset($_FILES[$this->file_input])) {
        $this->file_errors[] = "Some Error Occurred While Uploading File Check for encryption type in form";
    } else {
        $file = $_FILES[$this->file_input];
        $this->file = $file;

        if ($file['error'] != 0) {
            $this->file_errors[] = "Some Error Occurred While Uploading File";
        }

        if ($this->max_size != 0 && $file['size'] > $this->max_size) {
            $this->file_errors[] = "File Exceeds Maximum Size";
        }

        if (!empty($this->allow_format) && count($this->allow_format) > 0 && !in_array($file['type'], $this->allow_format)) {
            $this->file_errors[] = "The File Format Is Not Supported";
        }

        if (count($this->file_errors) == 0) {
            $destination = $_ENV['UPLOAD_DIR'];
            if ($this->destination != null) {
                $destination = $destination . "/" . trim($this->destination, '/');
            }

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $upload_path = time() . $file['name'];
            $destination .= "/" . $upload_path;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $this->upload_path = $destination;
                $data['isUpload'] = true;
                $data['upload_path'] = $this->upload_path;
            } else {
                $this->file_errors[] = "Error occurred while moving the file";
            }
        }
    }

    $data['error'] = $this->file_errors;
    return (object) $data;
}

}
