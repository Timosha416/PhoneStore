<?php
include '../Controllers/PhoneController.php';
$phoneId = $_POST['phoneId'];
$phoneController = new PhoneController();
$phoneController->deletePhone($phoneId);
