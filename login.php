<?php
require_once 'login_controller.php'
?>

<form method="POST" action="login.php">
    <input name="username" placeholder="Логин" required>
    <input name="password" type="password" placeholder="Пароль" required>
    <button type="submit">Войти</button>
</form>