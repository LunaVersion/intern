<?php
//đảm bảo rằng chỉ có một đối tượng duy nhất của lớp được tạo ra và sử dụng lại.
class Singleton {
    // Biến static giữ đối tượng duy nhất
    private static $instance = null;

    // Phương thức private constructor ngăn chặn việc tạo đối tượng ngoài lớp này
    private function __construct() {
        // Khởi tạo các thành phần của Singleton
    }

    // Phương thức để lấy thể hiện duy nhất của lớp
    public static function getInstance() {
        // Kiểm tra nếu đối tượng chưa tồn tại thì khởi tạo
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        // Trả về đối tượng duy nhất
        return self::$instance;
    }

    // Phương thức ngăn chặn việc sao chép đối tượng Singleton
    public function __clone() {}

    // Phương thức ngăn chặn việc unserialize đối tượng Singleton
    public function __wakeup() {}
}

// Sử dụng Singleton
$singleton1 = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

// Kiểm tra nếu cả hai đối tượng đều trỏ đến cùng một thể hiện
if ($singleton1 === $singleton2) {
    echo "Cả hai đối tượng đều là một.\n";
} else {
    echo "Hai đối tượng là khác nhau.\n";
}
