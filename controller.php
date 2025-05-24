<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';
require_once 'src/Car.php';
require_once 'src/CarStorage.php';

$storage = new CarStorage($pdo);

$editCar = null;
$editIndex = null;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['delete'])) {
        $deleteIndex = (int)$_POST['delete'];
        $storage->delete($deleteIndex);

    } elseif (isset($_POST['edit'])) {
        $editIndex = (int)$_POST['edit'];
        $editCar = $storage->get($editIndex);

    } elseif (isset($_POST['brand'], $_POST['model'], $_POST['vin'], $_POST['regNum'], $_POST['yearOfManufacture'])) {
        // получаем данные из формы
        $brand = trim($_POST["brand"]);
        $model = trim($_POST["model"]);
        $vin = trim($_POST["vin"]);
        $regNum = trim($_POST["regNum"]);
        $yearOfManufacture = $_POST["yearOfManufacture"];

        // валидация формы авто
        if ($brand === '') $errors[] = "Марка обязательна";
        if ($model === '') $errors[] = "Модель обязательна";
        if ($vin === '' || strlen($vin) !== 17) $errors[] = "VIN должен состоять из 17 символов";
        if ($regNum === '') $errors[] = "Гос.номер обязателен";
        if (!is_numeric($yearOfManufacture) || (int)$yearOfManufacture < 1900 || (int)$yearOfManufacture > (int)date('Y')) {
            $errors[] = "Год выпуска должен быть от 1900 до настоящего";
        }

        // если нет ошибок — создаём или обновляем
        if (empty($errors)) {
            if (isset($_POST['editIndex']) && $_POST['editIndex'] !== '') {
                $editIndex = (int)$_POST['editIndex'];
                $car = new Car($editIndex, $brand, $model, $regNum, $vin, (int)$yearOfManufacture, $_SESSION['user_id']);
                $storage->update($editIndex, $car);
            } else {
                $car = new Car(null, $brand, $model, $regNum, $vin, (int)$yearOfManufacture, $_SESSION['user_id']);
                $storage->add($car);
            }

            header('Location: index.php');
            exit;
        } else {
            // если есть ошибки — сохраняем авто для формы
            $editCar = new Car(null, $brand, $model, $regNum, $vin, (int)$yearOfManufacture, $_SESSION['user_id']);
        }
    }
}
