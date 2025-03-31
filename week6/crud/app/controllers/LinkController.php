<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class LinkController extends Controller
{

    public function link() {
        $this->view('link');
    }

}
