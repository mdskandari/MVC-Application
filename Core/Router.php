<?php namespace Core;


use mysql_xdevapi\Exception;

class Router
{
    protected array $routes = [];
    protected array $params = [];
    protected string $namespace = 'App\Controllers\\';

    public function add(string $route, $params): void
    {
        $route = preg_replace('/^\//', '', $route);
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?<\1>[a-z0-9-]+)', $route);
        $route = '/^' . $route . '\/?$/i';
        $allParams = [];
        if (is_string($params)) {
            list($allParams['controller'], $allParams['method']) = explode('@', $params);
        }

        if (is_array($params)) {
            list($allParams['controller'], $allParams['method']) = explode('@', $params['uses']);
            unset($params['uses']);
            $allParams = array_merge($allParams, $params);
        }

        $this->routes[$route] = $allParams;
    }

    public function match($url): bool
    {
        foreach ($this->routes as $route => $param) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $param['params'][$key] = $match;
                    }
                }
                $this->params = $param;
                return true;
            }
        }
        return false;
    }


    public function getRoutes(): array
    {
        return $this->routes;
    }


    public function getParams(): array
    {
        return $this->params;
    }


    public function dispatch(string $url): void
    {
        $url = $this->removeQueryString($url);
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->getNamespace() . $controller;
            if (class_exists($controller)) {
                $controller = new $controller();

                $method = $this->params['method'];

                if (is_callable([$controller, $method])) {
                    echo call_user_func_array([$controller, $method], $this->params['params']);
                } else {
                    throw new \Exception('Method ' . $method . ' not found in controller ' . $controller);
                }
            } else {
                throw new \Exception("Controller Class {$controller} not found");
            }
        } else {
            throw new \Exception('No route found for this URL',404);
        }
    }


    protected function getNamespace(): string
    {
        $namespace = $this->namespace;
        if (array_key_exists('namespace', $this->params))
            $namespace .= $this->params['namespace'] . '\\';
        return $namespace;
    }

    protected function removeQueryString(string $url): string
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false)
                $url = $parts[0];
            else
                $url = '';

            return $url;
        }
    }
}