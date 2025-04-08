<?php
require_once "CarCreator.php";
require_once "BicycleCreator.php";

// Tạo đối tượng từ factory
$carCreator = new CarCreator("black", 5);
$car = $carCreator->createTransport();
$car->deliver(); 

$bicycleCreator = new BicycleCreator();
$bicycle = $bicycleCreator->createTransport();
$bicycle->deliver(); 
