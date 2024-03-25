<?php 

declare(strict_types=1);

namespace App\Exceptions;

class MethodNotFoundException extends \Exception {

protected  $message = "ERROR 404 Method Not Found";

  public function getMsg() : string{

     return $this->message;

  }



}