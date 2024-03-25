<?php 

namespace App\Core\Http;

class Request {
    private $get;
    private $post;
    private $headers;
    private $files;
    private $server;
    private $cookie;
    

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->headers = getallheaders();
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
    }
  
     public function get(string $key = null, string $default = ''){

        if($key === null){
          return $this->get;
        }
        return $this->get[$key] ?? $default;

     }


    public function post(string $key = null, string $default = '') {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }

    public function file(string $key = null) {
        if ($key === null) {
            return $this->file;
        }
        return $this->file[$key] ?? null;
    }

    public function header(string $key = null) {
         if ($key === null) {
            return $this->headers;
        }
        return $this->headers[$key] ?? null;
    }

    public function server(string $key = null) {
         if ($key === null) {
            return $this->server;
        }
        return $this->server[$key] ?? null;
    }

    public function cookie(string $key = null) {
       if ($key === null) {
            return $this->cookie;
        }
        return $this->cookie[$key] ?? $default;
    }

    public function allHeaders() {
        return $this->headers;
    }

    public function hasFile( string $key) {
        return isset($this->files[$key]);
    }
}

?>
