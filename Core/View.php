<?php

namespace Core;

use Philo\Blade\Blade;

class View
{
    public static function render($view, array $args = []): void
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/{$view}.php";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("{$file} Not Found");
        }
    }


    public static function renderTemplate($template, $args = []): string
    {
        $views = realpath(__DIR__ . '/../App/Views');
        $cache = realpath(__DIR__ . '/../storage/views');

        $blade = new Blade($views, $cache);

        return $blade->view()->make($template, $args)->render();
    }
}