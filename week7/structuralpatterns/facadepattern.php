<?php
// dùng khi muốn đưa ra một api đơn giản trong khi hệ thống quá phức tạp
// đơn giản hóa 1 hệ thống phức tạp
class EmailService {
    public function sendEmail($message) {
        echo "Gửi Email: $message\n";
    }
}

class SMSService {
    public function sendSMS($message) {
        echo "Gửi SMS: $message\n";
    }
}

class PushNotificationService {
    public function sendPush($message) {
        echo "Gửi Push Notification: $message\n";
    }
}

// Facade đơn giản hóa việc gửi thông báo
class NotificationFacade {
    private $email;
    private $sms;
    private $push;

    public function __construct() {
        $this->email = new EmailService();
        $this->sms = new SMSService();
        $this->push = new PushNotificationService();
    }

    public function sendNotification($message) {
        $this->email->sendEmail($message);
        $this->sms->sendSMS($message);
        $this->push->sendPush($message);
    }
}

//chỉ cần gọi 1 phương thức sendNotification
$notifier = new NotificationFacade();
$notifier->sendNotification("Xin chào!");
