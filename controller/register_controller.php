<?php
require_once 'db.php';
require_once 'src/UserStorage.php';

$userStorage = new UserStorage($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Все поля обязательны';
    } elseif ($userStorage->findByUsername($username)) {
        $errors[] = 'Пользователь существует';
    } else {
        $userStorage->create($username, $password);
        header('Location: login.php');
        exit;
    }
}