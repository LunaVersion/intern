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
        $this->view('link'); 
        // exit();
    }
    public function index() {
        $users = $this->userModel->getAllUsers();
        $this->view('user', ['users' => $users]);
    }
    public function edit() {
        if (!isset($_GET['id'])) {
            die("Không có ID!");
        }
    
        $id = $_GET['id'];

        $user = $this->userModel->getUserById($id);
        
        if (!$user) {
            die("Người dùng không tồn tại!");
        }
    
        // Hiển thị trang chỉnh sửa
        $this->view('edit', ['user' => $user]);
    }
    
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
    
            $this->userModel->updateUser($id, $name, $email);
    
            // Chuyển hướng về danh sách nhân viên
            $this->view('link');
            exit;
        }
    }
    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            die("ID không hợp lệ!");
        }
    
        $this->userModel->deleteUser($id);
    
        // Chuyển hướng về danh sách nhân viên
        $this->view('link');
        exit;
    }
    
}
