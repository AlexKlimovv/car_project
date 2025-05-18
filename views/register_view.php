<h2>Регистрация</h2>

<form method="post">
    <input name="username" placeholder="Имя пользователя">
    <input name="password" placeholder="Пароль">
    <button type="submit">Зарегистрироваться</button>
</form>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= htmlspecialchars($error)?></p>
<?php endforeach; ?>