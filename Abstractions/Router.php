<?php

declare(strict_types=1);

namespace Abstractions;

use DependencyInjection\IServiceProvider;
use InvalidArgumentException;

require_once 'Core/functions.php';

class Router {

    private array $routes = [];

    public function __construct(
        private readonly IServiceProvider $provider
    ) {
    }

    public function add(string $method, string $uri, array $controller) {

        if (count($controller) !== 2) {
            throw new InvalidArgumentException("El controlador debe ser de la forma '[MyClass:class, NombreMetodo]'");
        }

        $this->routes[strtoupper($method)][] = [
            'uri' => $uri,
            'controller' => $controller
        ];

        return $this;
    }

    public function get(string $uri, array $controller) {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, array $controller) {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, array $controller) {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, array $controller) {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, array $controller) {
        return $this->add('PUT', $uri, $controller);
    }

    private function match_path(string $uri, string $path, &$params) {

        $regex = preg_replace('/\{(\w+)\}/', '(?P<\1>[^\/]+)', $uri);
        $regex = '#^' . $regex . '$#';

        $params = [];

        if (preg_match($regex, $path, $matches)) {

            foreach ($matches as $key => $value) {

                if (is_string($key)) $params[$key] = $value;
            }

            return true;
        }

        return false;
    }

    public function route(string $path, string $method) {

        if (!isset($this->routes[strtoupper($method)])) {
            $this->abort();
            return;
        }

        $routes = $this->routes[strtoupper($method)];
        $found = false;

        if ($routes === null) {
            $this->abort();
            return;
        }

        foreach ($routes as $route) {

            $found = $this->match_path($route['uri'], $path, $params);

            if (!$found) continue;

            $controller = $route['controller'];

            $class = $controller[0];
            $endpoint = $controller[1];

            /* return template($route['controller'], $params); */
            return $this->prepare($class, $endpoint, $params);
        }

        $this->abort();
    }

    private function prepare(string $controllerType, string $endpoint, array $data = []) {
        return $this->provider->get_required_service($controllerType)->$endpoint(...$data);
    }

    private function abort($status = 404) {
        http_response_code($status);

        echo "Not Found";
    }
}
