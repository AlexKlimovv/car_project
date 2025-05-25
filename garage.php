<?php
session_start();

require_once 'db.php';
require_once 'src/CarStorage.php';
require_once 'src/Car.php';
require_once 'car_controller.php';

//для редактирования
$editCar = $editCar ?? null;
$editIndex = $editIndex ?? null;
$errors = $errors ?? [];

if (!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

$carStorage = new CarStorage($pdo);
$cars = $carStorage->getAllByUser($_SESSION['user_id']);

ob_start();
if ($editCar !== null) {
    require 'views/car_form.php';
}
require_once 'views/car_table.php';
$content = ob_get_clean();

require_once 'views/layout.php';