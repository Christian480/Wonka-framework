<?php

require_once __DIR__ . '/../framework/Router.php';

$router = new Router();

$router->get('/', function () {
    echo "Accueil du framework Wonka";
});

$router->get('/contact', function () {
    echo "Page Contact du framework Wonka";
});

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);