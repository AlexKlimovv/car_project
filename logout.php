<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header('Location: /PhpstormProjects/car_project/login.php');
} else {
    header('Location: /PhpstormProjects/car_project/index.php');
}
exit;