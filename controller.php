<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';
require_once 'src/Car.php';
require_once 'src/CarStorage.php';

$pdo = new PDO("mysql:host=172.19.0.3;port=3306;dbname=car_project", "root", "root");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$storage = new CarStorage($pdo);

$editCar = null;
$editIndex = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['delete'])) {
        $deleteIndex = (int)$_POST['delete'];
        $storage->delete($deleteIndex);
    } elseif (isset($_POST['edit'])) {
        $editIndex = (int)$_POST['edit'];
        $editCar = $storage->get($editIndex);
    } elseif (isset($_POST['brand'], $_POST['model'], $_POST['vin'], $_POST['regNum'], $_POST['yearOfManufacture'])) {
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $vin = $_POST["vin"];
        $regNum = $_POST["regNum"];
        $yearOfManufacture = $_POST["yearOfManufacture"];

        if (isset($_POST['editIndex']) && $_POST['editIndex'] !== '') {
            $editIndex = (int)$_POST['editIndex'];
            $car = new Car((int)$_POST['editIndex'], $brand, $model, $regNum, $vin, (int)$yearOfManufacture);
            $storage->update($editIndex, $car);
        } else {
            $car = new Car(null, $brand, $model, $regNum, $vin, $yearOfManufacture);
            $storage->add($car);
        }

        header('Location: index.php');
        exit;
    }
}