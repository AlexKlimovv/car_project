<?php
require_once 'db.php';
require_once 'src/UserStorage.php'; // временное подключение
require_once 'controller.php';


$userStorage = new UserStorage($pdo);
$carStorage = new CarStorage($pdo);
$errors = [];

ob_start();
require_once 'views/car_form.php';
require_once 'views/car_table.php';
$content = ob_get_clean();

require_once 'views/layout.php';

$editCar = $editCar ?? null;
$editIndex = $editIndex ?? null;
