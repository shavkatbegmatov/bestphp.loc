<?php

namespace App;

class Router {
    private array $routes = [];

    public function get(string $path, callable $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void {
        session_start();
        $uri = parse_url($uri, PHP_URL_PATH);
        $handler = $this->routes[$method][$uri] ?? null;

        // Поддержка маршрутов с параметрами типа /users/{id}
        if (!$handler) {
            foreach ($this->routes[$method] as $route => $callback) {
                $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_]+)', $route);
                if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                    array_shift($matches);
                    echo call_user_func_array($callback, $matches);
                    return;
                }
            }

            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        echo call_user_func($handler);
    }
}