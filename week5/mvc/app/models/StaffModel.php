<?php
require_once __DIR__ . '/../core/Database.php'; 

class StaffModel {
    private $db;

    public function __construct() {
        $database = new Database(); 
        $this->db = $database->conn; // Gán kết nối PDO
    }

    public function insertStaff($ho_ten, $ngay_sinh,$gioi_tinh,$so_dien_thoai,$email,$dia_chi,$avatar) {
        try {
            $sql = "INSERT INTO nhan_vien (ho_ten, ngay_sinh, gioi_tinh, so_dien_thoai, email, dia_chi, avatar) 
                    VALUES (:ho_ten, :ngay_sinh, :gioi_tinh, :so_dien_thoai, :email, :dia_chi, :avatar)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':avatar', $avatar);
            $stmt->execute();

            $lastId = $this->db->lastInsertId(); // Lấy ID mới chèn
            //var_dump($lastId); // Xem ID có thực sự được tạo không
            return $lastId;
            
            //return $stmt->execute(); // Trả về true nếu thành công
            // return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Lỗi thêm nhân viên: " . $e->getMessage());
        }
    }
    public function insertSalary($id_nhan_vien,$so_tien_luong,$thang_nhan_luong) {
        try {
            $sql = "INSERT INTO bang_luong (id_nhan_vien,so_tien_luong, thang_nhan_luong) 
                    VALUES (:id_nhan_vien,:so_tien_luong, :thang_nhan_luong)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_nhan_vien', $id_nhan_vien);
            $stmt->bindParam(':so_tien_luong', $so_tien_luong);
            $stmt->bindParam(':thang_nhan_luong', $thang_nhan_luong);
            
            return $stmt->execute(); // Trả về true nếu thành công
        } catch (PDOException $e) {
            die("Lỗi thêm nhân viên: " . $e->getMessage());
        }
    }
    public function insertDepartmentsStaffModel($id_phong_ban,$id_nhan_vien,$chuc_vu) {
        try {
            $sql = "INSERT INTO nhan_vien_phong_ban (id_phong_ban,id_nhan_vien,chuc_vu) 
                    VALUES (:id_phong_ban,:id_nhan_vien,:chuc_vu)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_phong_ban', $id_phong_ban);
            $stmt->bindParam(':chuc_vu', $chuc_vu);
            $stmt->bindParam(':id_nhan_vien', $id_nhan_vien);
            
            return $stmt->execute(); 
        } catch (PDOException $e) {
            die("Lỗi thêm nhân viên: " . $e->getMessage());
        }
    }

    //lấy danh sách nhân viên và phòng ban
    public function getAllStaffAndDepartment() {
        $sql = "SELECT 
                    nv.id_nhan_vien, 
                    nv.ho_ten, 
                    pb.id_phong_ban, 
                    pb.ten_phong_ban
                FROM nhan_vien nv
                JOIN nhan_vien_phong_ban nvpb ON nv.id_nhan_vien = nvpb.id_nhan_vien
                JOIN phong_ban pb ON nvpb.id_phong_ban = pb.id_phong_ban;
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllStaffWithDepartment() {
        $sql = "SELECT 
                    nv.id_nhan_vien, 
                    nv.ho_ten, 
                    pb.id_phong_ban, 
                    pb.ten_phong_ban
                FROM nhan_vien nv
                JOIN nhan_vien_phong_ban nvpb ON nv.id_nhan_vien = nvpb.id_nhan_vien
                JOIN phong_ban pb ON nvpb.id_phong_ban = pb.id_phong_ban
                ORDER BY pb.id_phong_ban";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalSalaryByMonth($month, $year) {
        $sql = "SELECT SUM(so_tien_luong) AS total_salary 
                FROM bang_luong 
                WHERE MONTH(thang_nhan_luong) = :month 
                AND YEAR(thang_nhan_luong) = :year";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
    
        $totalSalary = $stmt->fetchColumn();

        // Debug giá trị totalSalary
        //var_dump($totalSalary); die();
        // var_dump([
        //     'month' => $month,
        //     'year' => $year,
        //     'totalSalary' => $totalSalary,
        //     'type' => gettype($totalSalary) => totalSalary đang là string
        // ]); 

        return $totalSalary; 
    }
    
}
?>
