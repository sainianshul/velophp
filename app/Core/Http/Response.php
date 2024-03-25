<?php

namespace App\Core\Http;

use App\Core\View\View;

class Response
{
    private $data = '';
    private $statusCode = 200;
    private $headers = [];
    private $type = null;

    public static function data()
    {
        return new self('data');
    }

    public static function json(array $data)
    {
        return new self('json', json_encode($data));
    }

    public static function view(string $template, ?array $params = [])
    {
        $view = new View('twig','../app/Views');
        return new self('view', $view->render($template, $params));
    }

    public static function download(string $path)
    {
        $response = new self('download', file_get_contents($path));
        $response->headers[] = "Content-Disposition: attachment; filename=\"" . basename($path) . "\"";
        return $response;
    }

    public static function redirect(string $uri, int $statusCode = 302)
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_ENV['URI'] . '/' . ltrim($uri, '/');
        return new self('redirect', '', $statusCode, $url);
    }

    public static function back()
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . ltrim($_SERVER['HTTP_REFERER'], '/');
        return new self('back', '', 302, $url);
    }

    public function __construct(string $type, string $data = '', int $statusCode = 200, string $url = '')
    {
        $this->type = $type;
        $this->data = $data;
        $this->statusCode = $statusCode;
        if ($url) {
            $this->headers[] = 'Location: ' . $url;
        }
    }

    public function header(string $header)
    {
        $this->headers[] = $header;
        return $this;
    }

    public function status(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $header) {
            header($header);
        }
        if ($this->type == "redirect" || $this->type == "back") {
            exit;
        } elseif ($this->type == "data" || $this->type == "download" || $this->type == "view") {
            echo $this->data;
        } else {
            echo "Invalid response! Response type is not valid.";
            exit;
        }
    }
}
