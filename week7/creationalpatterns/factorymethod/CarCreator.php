<?php
require_once "TransportCreator.php";
require_once "Car.php";
require_once "Transport.php";
class CarCreator extends TransportCreator {
    private $color;
    private $number;

    public function __construct($color, $number) {
        $this->color = $color;
        $this->number = $number;
    }

    public function createTransport(): Transport {
        return new Car($this->color, $this->number);
    }
}