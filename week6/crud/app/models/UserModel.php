<?php 
require_once __DIR__ . '/../core/Database.php'; 

class UserModel {
    private $db;

    public function __construct() {
        $database = new Database(); 
        $this->db = $database->conn; // Gán kết nối PDO
    }
    
    public function insertUser($name, $email) {
        try {
            $sql = "INSERT INTO users (name, email) 
                    VALUES (:name, :email )";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            
            return $stmt->execute(); // Trả về true nếu thành công
        } catch (PDOException $e) {
            die("Lỗi thêm người dùng: " . $e->getMessage());
        }
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM users  ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateUser($id, $name, $email) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $id]);
    }
    
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
}