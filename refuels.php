<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'db.php';
require_once 'src/Refuel.php';
require_once 'src/RefuelStorage.php';
require_once 'src/Car.php';
require_once 'src/CarStorage.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

$refuelStorage = new RefuelStorage($pdo);
$carStorage = new CarStorage($pdo);

$userCars = $carStorage->getAllByUser($userId);

$selectedCarId = $_GET['car_id'] ?? null;

if ($selectedCarId) {
    $refuels = $refuelStorage->getAllByCarId((int)$selectedCarId);
} else {
    $refuels = $refuelStorage->getAllByUserId($userId);
}

$carMap = [];
foreach ($userCars as $car) {
    $carMap[$car->id] = $car;
}

ob_start();
require_once 'views/refuel_list.php';
$content = ob_get_clean();

require_once 'views/layout.php';