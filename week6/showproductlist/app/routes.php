<?php

$routes = [
    '' => ['controller' => 'ProductController', 'method' => 'index'],
    '/store' => ['controller' => 'StoreController', 'method' => 'index'],
    // '/contact' => ['controller' => 'Contact', 'method' => 'sendMessage']
];

function getRoute($url) {
    global $routes;

    // Chuyển URL thành dạng "/path"
    $path = '/' . implode('/', $url);

    // Kiểm tra route, nếu không có thì mặc định về trang chủ
    return $routes[$path] ?? ['controller' => 'ProductController', 'method' => 'index'];
}
?>
