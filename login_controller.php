<?php
session_start();
require_once 'db.php';
require_once 'src/UserStorage.php';

$userStorage = new UserStorage($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']) ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Заполнить все поля';
    } else {
        $user = $userStorage->findByUsername($username);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Неверный логин или пароль';
        }
    }
}

