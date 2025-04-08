<?php
//dùng khi cần sử dụng 1 class cũ với interface khác với yêu cầu hiện tại
//VD có 1 hệ thống ttoán mới nhưng cần hỗ trợ thư viện ttoan cũ

// Giao diện thanh toán mới
interface PaymentProcessor {
    public function pay($amount);
}

// Hệ thống thanh toán cũ tuân theo interface cũ
class OldPaymentSystem {
    public function sendPayment($money) {
        echo "Thanh toán $money bằng hệ thống cũ.\n";
    }
}

// tạo adapter kết nối 2 hệ thống
class PaymentAdapter implements PaymentProcessor {
    private $oldSystem;

    public function __construct(OldPaymentSystem $oldSystem) {
        $this->oldSystem = $oldSystem;
    }

    public function pay($amount) {
        $this->oldSystem->sendPayment($amount);
    }
}

// Sử dụng Adapter
$oldPayment = new OldPaymentSystem();
$payment = new PaymentAdapter($oldPayment);
$payment->pay(100);
