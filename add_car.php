<?php
session_start();
require_once 'db.php';
require_once 'src/Car.php';
require_once 'src/CarStorage.php';
require_once 'car_controller.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$editCar = null;
$editIndex = null;
$errors = [];

ob_start();
require_once 'views/car_form.php';
$content = ob_get_clean();

require_once 'views/layout.php';