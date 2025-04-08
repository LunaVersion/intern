<?php
// dùng khi muốn tách rời phần yêu cầu thực thi (request) và phần hành động (action)
// khi cần lưu trữ các lệnh/hành động để redo/undo (stack); thực hiện lệnh theo lịch trình (queue)

//đóng gói hành động bật/tắt tivi/quạt
interface Command {
    public function execute();
}

// Các thiết bị
class TV {
    public function turnOn() {
        echo "TV is ON\n";
    }

    public function turnOff() {
        echo "TV is OFF\n";
    }
}

class Fan {
    public function turnOn() {
        echo "Fan is ON\n";
    }

    public function turnOff() {
        echo "Fan is OFF\n";
    }
}

class TurnOnTVCommand implements Command {
    private $tv;

    public function __construct($tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOn();
    }
}

class TurnOffTVCommand implements Command {
    private $tv;

    public function __construct($tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOff();
    }
}

class TurnOnFanCommand implements Command {
    private $fan;

    public function __construct($fan) {
        $this->fan = $fan;
    }

    public function execute() {
        $this->fan->turnOn();
    }
}

class TurnOffFanCommand implements Command {
    private $fan;

    public function __construct($fan) {
        $this->fan = $fan;
    }

    public function execute() {
        $this->fan->turnOff();
    }
}

// Lớp RemoteControl điều khiển các lệnh
class RemoteControl {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function pressButton() {
        $this->command->execute();
    }
}

// Sử dụng
$tv = new TV();
$fan = new Fan();

$turnOnTV = new TurnOnTVCommand($tv);
$turnOffTV = new TurnOffTVCommand($tv);
$turnOnFan = new TurnOnFanCommand($fan);
$turnOffFan = new TurnOffFanCommand($fan);

$remote = new RemoteControl();

// Điều khiển TV và quạt mà không cần phải trực tiếp tạo các đối tượng TV, Fan trong RemoteControl
$remote->setCommand($turnOnTV);
$remote->pressButton();

$remote->setCommand($turnOnFan);
$remote->pressButton();
