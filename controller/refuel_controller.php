<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../src/Refuel.php';
require_once __DIR__ . '/../src/RefuelStorage.php';
require_once __DIR__ . '/../src/Car.php';
require_once __DIR__ . '/../src/CarStorage.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

$refuelStorage = new RefuelStorage($pdo);
$carStorage = new CarStorage($pdo);
$errors = [];
$success = false;

$refuels = $refuelStorage->getAllByUserId($userId);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? null) === 'create') {
    $refuel = null;
    $userCars = $carStorage->getAllByUser($userId);

    ob_start();
    require_once __DIR__ . '/../views/refuel_form.php';
    $content = ob_get_clean();
    require_once __DIR__ . '/../views/layout.php';
    exit;
}

$userCars = $carStorage->getAllByUser($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['car_id'], $_POST['mileage'], $_POST['liters'], $_POST['pricePerLiter'])) {
        //получение данных из формы
        $carId = $_POST[ "car_id"];
        $mileage = trim($_POST["mileage"]);
        $liters = trim($_POST["liters"]);
        $pricePerLiter = trim($_POST["pricePerLiter"]);
        $isFull = isset($_POST["isFull"]) ? 1 : 0;

        if ($carId === '') $errors[] = "Выберите авто";
        if ($mileage ==='') $errors[] = "Километраж обязателен";
        if (strlen($mileage) > 6) $errors[] = "Километраж не должен быть более 6 символов";
        if (!is_numeric($mileage) || $mileage <= 0) $errors[] = "Километраж должен быть положительным числом";
        if ($liters === '') $errors[] = "Количество литров обязательно";
        if ($pricePerLiter === '') $errors[] = "Цена за литр обязательна";
    }
    
    $car = $carStorage->getById($carId);
    if (!$car || $car->userId !== $userId) {
        $errors[] = "Машина не найдена или не принадлежит вам";
    }
    
    if (empty($errors)) {
        $refuel = new Refuel (
            null,
            (int)$carId,
            (int)$mileage,
            (int)$userId,
            (float)$liters,
            (float)$pricePerLiter,
            $isFull,
            date('Y-m-d H:i:s')
        );

        if ($refuelStorage->addRefuel($refuel)) {
            header('Location: /PhpstormProjects/car_project/refuels.php');
            exit;
        } else {
            $errors [] = "Не удалось сохранить заправку.";
        }
    }
}