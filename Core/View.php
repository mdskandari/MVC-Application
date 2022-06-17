<?php

namespace Core;

//use Philo\Blade\Blade;
use eftec\bladeone\BladeOne;

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

//        $views = __DIR__ . '/views';
//        $cache = __DIR__ . '/cache';

//        $blade = new Blade($views, $cache);
        $blade = new BladeOne($views,$cache,BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.

//        return $blade->view()->make($template, $args)->render();
        return $blade->run($template,$args); // it calls /views/hello.blade.php


    }
}