<?php
require_once "Transport.php";
class Car implements Transport {
    private $color;
    private $number;

    public function __construct($color, $number) {
        $this->color = $color;
        $this->number = $number;
    }
    public function deliver() {
        echo "Delivering a {$this->color} car with {$this->number} seats!\n";
    }
}