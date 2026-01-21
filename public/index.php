<?php

require_once __DIR__ . '/../src/Router.php';

use MiniRouter\Router;

$router = new Router();

/**
 * Home page
 */
$router->get('/', function () {
    return "
        <h1>Home</h1>
        <p>Bine ai venit la demo MiniRouter</p>
        <ul>
            <li><a href='/users/5'>User 5</a></li>
            <li><a href='/users/10'>User 10</a></li>
            <li><a href='/contact'>Contact</a></li>
        </ul>
    ";
});

/**
 * Dynamic user page
 */
$router->get('/users/{id}', function ($params) {
    return "
        <h1>User page</h1>
        <p>User ID: <strong>{$params['id']}</strong></p>
        <a href='/'>Back to home</a>
    ";
});

/**
 * Contact page
 */
$router->get('/contact', function () {
    return "
        <h1>Contact</h1>
        <p>Email: demo@example.com</p>
        <a href='/'>Back to home</a>
    ";
});

/**
 * Dispatch request
 */
echo $router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
