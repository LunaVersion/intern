<?php
require_once __DIR__ . '/../core/Controller.php'; 
class Home extends Controller {
    public function index() {
        $this->view('home/index');
    }
    public function query() {
        $this->view('home/query');
    }
}
