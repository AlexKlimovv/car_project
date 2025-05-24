<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once 'db.php';
require_once 'src/Repair.php';
require_once 'src/RepairStorage.php';
require_once 'src/CarStorage.php';
require_once 'src/Car.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$repairStorage = new RepairStorage($pdo);
$carStorage = new CarStorage($pdo);

$userCars = $carStorage->getAllByUser($userId);

$selectedCarId = $_GET['car_id'] ?? null;
if ($selectedCarId) {
    $repairs = $repairStorage->getByCarId((int)$selectedCarId);
} else {
    $repairs = $repairStorage->getByUserId($userId);
}

$carMap = [];
foreach ($userCars as $car) {
    $carMap[$car->id] = $car;
}

ob_start();
require_once 'views/repair_list.php';
$content = ob_get_clean();
require_once 'views/layout.php';