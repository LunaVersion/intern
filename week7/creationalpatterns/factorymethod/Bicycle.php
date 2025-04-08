<?php
require_once "Transport.php";
class Bicycle implements Transport {
    public function deliver() {
        echo "Delivering by bicycle!\n";
    }
}