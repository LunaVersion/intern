<?php
require_once __DIR__ . '/../routes.php';
class App {

    public function __construct(){
        $url = $this->parseUrl(); // Lấy URL từ request
        $route = getRoute($url); // Lấy route từ routes.php

        $this->controller = $route['controller'];
        $this->method = $route['method'];

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        $this->params = array_values($url);

        call_user_func_array([$this->controller, $this->method], $this->params);;
    }

    public function parseUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            // echo $_GET['url'];
            // tách chuỗi để lấy controller, method, params từ URL
            // dùng trim thay cho rtrim vì khi explode sẽ không bị phần tử rỗng đầu mảng
            return $url = explode('/',filter_var(trim($_SERVER['REQUEST_URI'],'/'), FILTER_SANITIZE_URL));
        }
        return [];
        //php built in server không hỗ trợ htaccess nên $_GET['url'] ko hoạt động
        // echo $_SERVER['REQUEST_URI'];
    }
}