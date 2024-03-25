<?php

namespace App\Core\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    private static Environment $twig;

    public static function initTwig()
    {
        $loader = new FilesystemLoader('../app/Views');
        self::$twig = new Environment($loader);
    }

    public static function render(string $template, array $data = [])
    {
        if (!isset(self::$twig)) {
            self::initTwig();
        }
        return  self::$twig->render($template, $data);
    }


}
