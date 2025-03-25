<?php
require_once __DIR__ . '/../core/Controller.php'; 
class Home extends Controller {
    public function index($name = '' ){
        // echo 'home/index';
        $user = $this->model('User'); //gọi model User và tạo đối tượng User
        $user -> name = 'Luna';
        $this->view('home/index',['name' => $user->name]);
        // echo $user->name;
    }
}