<h2>Регистрация</h2>

<form method="post">
    <input name="username" placeholder="Имя пользователя">
    <input name="password" placeholder="Пароль">
    <button type="submit">Зарегистрироваться</button>
</form>

<?php foreach ($errors as $e): ?>
    <p style="color: red"><?= htmlspecialchars($e)?></p>
<?php endforeach; ?>