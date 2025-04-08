<?php
// dùng khi cần thông báo đến các đối tượng khác khi có 1 đối tượng thay đổi
interface Observer {
    public function update($videoTitle);
}

class Subscriber implements Observer {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function update($videoTitle) {
        echo "{$this->name} nhận thông báo: Video mới - '{$videoTitle}'!\n";
    }
}

class YouTubeChannel {
    private $subscribers = []; // Danh sách người đăng ký

    //lưu tất cả những ai đã đăng kí vào $subscriber[] 
    public function subscribe(Observer $subscriber) {
        $this->subscribers[] = $subscriber;
    }

    public function uploadVideo($videoTitle) {
        echo "Kênh YouTube vừa đăng video mới: '{$videoTitle}'\n";
        $this->notifySubscribers($videoTitle);
    }

    private function notifySubscribers($videoTitle) {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->update($videoTitle);
        }
    }
}

$channel = new YouTubeChannel();

$subscriber1 = new Subscriber("Lê Thị Hương");
$subscriber2 = new Subscriber("Lê Quốc Khánh");
$subscriber3 = new Subscriber("Hoàng Tuấn Tú");

$channel->subscribe($subscriber1);
$channel->subscribe($subscriber2);
$channel->subscribe($subscriber3);

$channel->uploadVideo("Học Observer Pattern trong PHP");
?>

