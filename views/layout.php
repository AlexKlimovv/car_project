<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Car Project</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td, { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: center; background-color: #f5f5f4; padding: 10px; margin-bottom: 20px">
    <span>Пользователь:<strong><?= htmlspecialchars($_SESSION['username'])?></strong></span>
    <a href="/PhpstormProjects/car_project/add_car.php">Добавить авто</a>
    <a href="/PhpstormProjects/car_project/garage.php">Гараж</a>
    <a href="/PhpstormProjects/car_project/repairs.php">Ремонты</a>
    <a href="#">Заправки</a>

    <form action="/PhpstormProjects/car_project/logout.php" method="post">
    <button type="submit">Выйти</button>
    </form>
</div>
<?= $content ?>

</body>
</html>