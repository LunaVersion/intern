<?php
//sử dụng khi muốn thêm tính năng mới hoặc mở rộng chức năng của 1 class mà ko sửa trực tiếp class đó
//vd thêm tính năng ghi log khi gửi email
// Lớp gửi email gốc
// class EmailSender {
//     public function send($message) {
//         echo "Gửi email: $message\n";
//     }
// }

// // Decorator để thêm logging
// class EmailLogger {
//     private $emailSender;

//     public function __construct(EmailSender $emailSender) {
//         $this->emailSender = $emailSender;
//     }

//     public function send($message) {
//         echo "Ghi log: Đang gửi email\n";
//         $this->emailSender->send($message);
//     }
// }

// // Sử dụng Decorator
// $email = new EmailSender();
// $loggedEmail = new EmailLogger($email);
// $loggedEmail->send("Hello!");


// Lớp cơ bản
interface Beverage {
    public function getCost();
    public function getDescription();
}

// Lớp chính
class Coffee implements Beverage {
    public function getCost() {
        return 10;
    }

    public function getDescription() {
        return "Cà phê";
    }
}

// Lớp Decorator chung
abstract class BeverageDecorator implements Beverage {
    protected $beverage;

    public function __construct(Beverage $beverage) {
        $this->beverage = $beverage;
    }

    abstract public function getCost();
    abstract public function getDescription();
}

// Các lớp Decorator cụ thể
class Milk extends BeverageDecorator {
    public function getCost() {
        return $this->beverage->getCost() + 2; // Thêm 2 vào giá
    }

    public function getDescription() {
        return $this->beverage->getDescription() . " + Sữa";
    }
}

class Sugar extends BeverageDecorator {
    public function getCost() {
        return $this->beverage->getCost() + 2; // Thêm 2 vào giá
    }

    public function getDescription() {
        return $this->beverage->getDescription() . " + Đường";
    }
}

// Sử dụng
$coffee = new Coffee(); // Cà phê đơn giản
$coffeeWithMilk = new Milk($coffee); // Thêm sữa
$coffeeWithMilkAndSugar = new Sugar($coffeeWithMilk); // Thêm đường

echo $coffeeWithMilkAndSugar->getDescription() . " - Giá: " . $coffeeWithMilkAndSugar->getCost();
