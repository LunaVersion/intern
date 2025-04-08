<?php
//giúp thay đổi hành vi của nó khi trạng thái nội bộ của nó thay đổi
//sử dụng trong các hệ thống có trạng thái rõ ràng, và khi 1 đối tượng có nhiều trạng thái, 
// hành vi thay đổi tùy thuộc vào trạng thái

// định nghĩa các phương thức mà mỗi state phải thực thi
interface State {
    public function insertMoney();
    public function selectProduct();
    public function dispenseProduct();
}

// Concrete State 1: 
class ReadyState implements State {
    private $machine;

    public function __construct($machine) {
        $this->machine = $machine;
    }

    public function insertMoney() {
        echo "Money inserted, you can select a product.\n";
        $this->machine->setState(new WaitingForPaymentState($this->machine));
    }

    public function selectProduct() {
        echo "Please insert money first.\n";
    }

    public function dispenseProduct() {
        echo "Please insert money first.\n";
    }
}

// Concrete State 2:
class WaitingForPaymentState implements State {
    private $machine;

    public function __construct($machine) {
        $this->machine = $machine;
    }

    public function insertMoney() {
        echo "Money already inserted.\n";
    }

    public function selectProduct() {
        echo "Product selected, dispensing...\n";
        $this->machine->setState(new DispensingState($this->machine));
    }

    public function dispenseProduct() {
        echo "You need to select a product first.\n";
    }
}

// Concrete State 3:
class DispensingState implements State {
    private $machine;

    public function __construct($machine) {
        $this->machine = $machine;
    }

    public function insertMoney() {
        echo "Please wait, product is being dispensed.\n";
    }

    public function selectProduct() {
        echo "Please wait, product is being dispensed.\n";
    }

    public function dispenseProduct() {
        echo "Product dispensed. Returning to Ready state.\n";
        $this->machine->setState(new ReadyState($this->machine));
    }
}

// Context: giữ và thay đổi trạng thái máy bán hàng
class VendingMachine {
    private $state;

    public function __construct() {
        $this->state = new ReadyState($this); 
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function insertMoney() {
        $this->state->insertMoney();
    }

    public function selectProduct() {
        $this->state->selectProduct();
    }

    public function dispenseProduct() {
        $this->state->dispenseProduct();
    }
}

// Example usage:
$machine = new VendingMachine();
$machine->insertMoney(); // Chuyển sang WaitingForPaymentState
$machine->selectProduct(); // Chuyển sang DispensingState
$machine->dispenseProduct(); // Quay lại ReadyState

