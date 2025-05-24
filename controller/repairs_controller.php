<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__.'/../db.php';
require_once __DIR__.'/../src/Repair.php';
require_once __DIR__.'/../src/RepairStorage.php';
require_once __DIR__.'/../src/CarStorage.php';
require_once __DIR__.'/../src/Car.php';

$repairStorage = new RepairStorage($pdo);
$carStorage = new CarStorage($pdo);

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'create') {
    $repair = null;
    $errors = [];
    $userId = $_SESSION['user_id'];
    $userCars = $carStorage->getAllByUser($userId);

    ob_start();
    require_once __DIR__.'/../views/repair_form.php';
    $content = ob_get_clean();
    require_once __DIR__.'/../views/layout.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $carId = $_POST['car_id'] ?? '';
    $odometer = $_POST['odometer'] ?? '';
    $description = trim($_POST['description'] ?? '');
    $workCost = $_POST['work_cost'] ?? null;
    $partsCost = $_POST['parts_cost'] ?? null;

    if ($carId === '' || !$carStorage->belongsToUser($carId, $userId)){
        $errors[] = 'Выберите автомобиль';
    }
    if ($odometer === '' || !is_numeric($odometer)) {
        $errors[] = 'Показания одометра обязательны';
    }
    if ($description === '') {
        $errors[] = 'Описание ремонта обязательно';
    }

    if (empty($errors)) {
        $repair = new Repair(
            null,
            (int)$carId,
            (int)$odometer,
            $description,
            (float)$workCost,
            (float)$partsCost,
            date('Y-m-d H:i:s'),
            false
        );
        $repairStorage->add($repair);
        header('Location: /PhpstormProjects/car_project/repairs.php');
        exit;
    }
}