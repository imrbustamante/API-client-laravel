<?php 

namespace App\Types;

class BaseResponse{
    public $sucess;
    public $data;
    public $message;

    public function __construct($data, $sucess = true, $message = ''){
        $this->sucess = $sucess;
        $this->data = $data;
        $this->message = $message;
    }
}