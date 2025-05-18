<?php
session_start();
require_once 'db.php';
require_once 'src/UserStorage.php'; // временное подключение
require_once 'src/CarStorage.php';
require_once 'src/Car.php';
require_once 'controller.php';

if (!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

$userStorage = new UserStorage($pdo);
$carStorage = new CarStorage($pdo);
$cars = $carStorage->getAllByUser($_SESSION['user_id']);

$errors = [];
$editCar = $editCar ?? null;
$editIndex = $editIndex ?? null;

ob_start();
require_once 'views/car_form.php';
require_once 'views/car_table.php';
$content = ob_get_clean();

require_once 'views/layout.php';