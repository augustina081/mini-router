<?php

use PHPUnit\Framework\TestCase;
use MiniRouter\Router;

require_once __DIR__ . '/../src/Router.php';

class RouterTest extends TestCase
{
    public function testStaticRoute()
    {
        $router = new Router();
        $router->get('/test', fn () => 'ok');

        $response = $router->dispatch('GET', '/test');

        $this->assertEquals('ok', $response);
    }

    public function testDynamicRoute()
    {
        $router = new Router();
        $router->get('/users/{id}', fn ($params) => $params['id']);

        $response = $router->dispatch('GET', '/users/7');

        $this->assertEquals('7', $response);
    }

    public function testNotFoundRoute()
    {
        $router = new Router();

        $response = $router->dispatch('GET', '/missing');

        $this->assertEquals('404 - Route not found', $response);
    }
}
