<?php

namespace App\Core\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    private Environment $twig;
    private string $engine = 'twig';

    public function __construct(string $engine,string $path)
    {
        $this->engine = $engine;
        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twig->render($template, $data);
    }
}
