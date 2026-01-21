<?php

namespace MiniRouter;

class Router {
    private array $routes = [];

    public function get(string $path, callable $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function dispatch(string $method, string $uri) {
        foreach ($this->routes as $route) {
            $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $route['path']);
            $pattern = "#^$pattern$#";

            if ($method === $route['method'] && preg_match($pattern, $uri, $matches)) {
                return call_user_func($route['handler'], $matches);
            }
        }

        http_response_code(404);
        return "404 - Route not found";
    }
}
