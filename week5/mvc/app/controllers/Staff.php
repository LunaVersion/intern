<?php
require_once __DIR__ . '/../models/StaffModel.php';

class Staff extends Controller {
    private $staffModel;

    public function __construct() {
        $this->staffModel = $this->model('StaffModel');
    }
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ho_ten = $_POST['ho-ten'];
            $ngay_sinh =$_POST['ngay-sinh'];
            $gioi_tinh = $_POST['gioi-tinh'];
            $so_dien_thoai = $_POST['so-dien-thoai'];
            $email = $_POST['email'];
            $dia_chi = $_POST['dia-chi'];
            $avatar = $_POST['avatar'];

            $id_phong_ban = $_POST['id-phong-ban'];

            $so_tien_luong = $_POST['so-tien-luong'];
            $thang_nhan_luong = $_POST['thang-nhan-luong'];
            $chuc_vu = $_POST['chuc-vu'];

            // $staffModel = $this->model('StaffModel');
            $id_nhan_vien = $this->staffModel->insertStaff($ho_ten,$ngay_sinh,$gioi_tinh,$so_dien_thoai,$email,$dia_chi,$avatar);

            $this->staffModel->insertSalary($id_nhan_vien,$so_tien_luong,$thang_nhan_luong);

            $this->staffModel->insertDepartmentsStaffModel($id_phong_ban,$id_nhan_vien,$chuc_vu);
        }
        $this->view('home/link');
        exit;
    }

    // public function index() {
    //     $staffList = $this->staffModel->getAllStaffAndDepartment();
    //     $staffWithDepartment = $this->staffModel->getAllStaffWithDepartment();
        
    //     $this->view('home/query', [
    //         'staffList' => $staffList,
    //         'staffWithDepartment' => $staffWithDepartment,
    //     ]);
    // }
    // public function query() {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         //var_dump($_POST); die();
    //         $month = $_POST["month"] ?? null;
    //         $year = $_POST["year"] ?? null;
    
    //         // Gọi model 
    //         $totalSalary = $this->staffModel->getTotalSalaryByMonth($month, $year);

    //         // var_dump([
    //         //     'totalSalary' => $totalSalary,
    //         //     'month' => $month,
    //         //     'year' => $year,
    //         // ]); 
    //         // die();

    //         $this->view('home/query', [
    //             'totalSalary' => $totalSalary,
    //             'month' => $month,
    //             'year' => $year,
    //         ]);
    //     }
        
    // }

    // nên gộp index và query lại
    public function index() {
        $data = [
            'staffList' => $this->staffModel->getAllStaffAndDepartment(),
            'staffWithDepartment' => $this->staffModel->getAllStaffWithDepartment(),
            'totalSalary' => null,
            'month' => null,
            'year' => null,
        ];
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // var_dump($_POST); die();
            $data['month'] = $_POST["month"] ?? null;
            $data['year'] = $_POST["year"] ?? null;
    
            // Gọi model để lấy tổng lương
            if ($data['month'] && $data['year']) {
                $data['totalSalary'] = $this->staffModel->getTotalSalaryByMonth($data['month'], $data['year']);
            }
        }
    
        // Chỉ gọi view **một lần duy nhất**
        // var_dump($data['staffList']); die();
        $this->view('home/query', $data);
    }
    
}
?>
