<?php

namespace config;

$router = new \Core\Router();

$router->add('/','HomeController@index');
$router->add('/series', ['uses' => 'SeriesController@index']);
$router->add('/series/{slug}', 'SeriesController@serie');
$router->add('/series/{slug}/episode/{id}', 'SeriesController@episode');//['use


return $router;
