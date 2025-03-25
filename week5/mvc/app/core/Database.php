<?php
class Database {
    private $host = "localhost";  
    private $port = "3307";        
    private $dbname = "quan_ly_nhan_vien";   
    private $username = "root";    
    private $password = "300303";  
    public $conn;

    public function __construct() {
        try {
            // Kết nối với MySQL thông qua cổng
            $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }
    public function getConnection() {
        return $this->conn; // Trả về kết nối PDO
    }
}
