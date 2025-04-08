<?php
require_once "Transport.php";
abstract class TransportCreator {
    abstract public function createTransport() : Transport; //trả về 1 đối tượng có kiểu Transport
}