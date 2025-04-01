<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController extends Controller
{
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email =$_POST['email'];

            $this->userModel->insertUser($name,$email);
        }
        // $this->view('link'); 
        $users = $this->userModel->getAllUsers();
        $this->view('user', ['users' => $users]);
        exit();
    }
    public function index() {
        $users = $this->userModel->getAllUsers();
        $this->view('user', ['users' => $users]);
    }
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
    
            $this->userModel->updateUser($id, $name, $email);
    
            // $this->view('link');
            $users = $this->userModel->getAllUsers();
            $this->view('user', ['users' => $users]);
            exit;
        }
    }
    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            die("ID không hợp lệ!");
        }
    
        $this->userModel->deleteUser($id);
    
        // $this->view('link');
        $users = $this->userModel->getAllUsers();
        $this->view('user', ['users' => $users]);
        exit;
    }
    
}
