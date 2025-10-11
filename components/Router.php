<?php

namespace components;

/**
 * Routing class that connects FE request with the actual Controller method
 * Controller filenames and method names should follow specific pattern
 */
class Router
{
    private array $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI(): ?string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

        return null;
    }

    public function run(): void
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                $segments = explode('/', $path);

                $controllerName = 'controllers\\' . ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));

                $controllerObject = new $controllerName();
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    break;
                }
            }
        }

    }
}