<?php
class Controller {
    public function model($model){ // tạo đối tượng từ model để dùng trong controller
        require_once __DIR__ . '/../models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data = []){
        require_once __DIR__ . '/../views/'.$view.'.php';
    }
}