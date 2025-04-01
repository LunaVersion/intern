<?php

$routes = [
    '' => ['controller' => 'UserController', 'method' => 'index'],
    '/store' => ['controller' => 'UserController', 'method' => 'store'],
    '/edit' => ['controller' => 'UserController', 'method' => 'edit'],
    '/update' => ['controller' => 'UserController', 'method' => 'update'],
    '/delete' => ['controller' => 'UserController', 'method' => 'delete'],
];

function getRoute($url) {
    global $routes;

    // Chuyển URL thành dạng "/path"
    $path = '/' . implode('/', $url);

    return $routes[$path] ?? ['controller' => 'UserController', 'method' => 'index'];
}
?>
