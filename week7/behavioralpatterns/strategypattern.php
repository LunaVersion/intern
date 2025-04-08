<?php
// dùng khi cần thay đổi thuật toán mà ko sửa code class chính

interface TaxStrategy {
    public function calculate($amount);
}

class VietnamTax implements TaxStrategy {
    public function calculate($amount) {
        return $amount * 0.1;
    }
}

class USATax implements TaxStrategy {
    public function calculate($amount) {
        return $amount * 0.07;
    }
}

class TaxCalculator {
    private $strategy;

    public function __construct(TaxStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function getTax($amount) {
        return $this->strategy->calculate($amount);
    }
}

// Sử dụng
$taxVN = new TaxCalculator(new VietnamTax());
echo $taxVN->getTax(1000); // 100
