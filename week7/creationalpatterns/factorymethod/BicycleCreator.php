<?php
require_once "TransportCreator.php";
require_once "Bicycle.php";
require_once "Transport.php";
class BicycleCreator extends TransportCreator {
    public function createTransport() : Transport {
        return new Bicycle();
    }
}