<h2>Ваши заправки</h2>

<form method="get" action="/PhpstormProjects/car_project/refuels.php">
    <label>Выберите авто:
        <select name="car_id" onchange="this.form.submit()">
            <option value="">Все авто</option>
            <?php foreach ($userCars as $car): ?>
                <option value="<?= htmlspecialchars($car->id) ?>" <?= ($selectedCarId == $car->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($car->brand . ' ' . $car->model . ' ' . $car->regNum) ?>
                </option>
            <?php endforeach ?>
        </select>
    </label>
</form>

<a href="/PhpstormProjects/car_project/controller/refuel_controller.php?action=create">Добавить заправку</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Дата</th>
        <th>Авто</th>
        <th>Километраж</th>
        <th>Литры</th>
        <th>Цена за литр</th>
        <th>Полный бак?</th>
    </tr>
    <?php foreach ($refuels as $refuel): ?>
        <tr>
            <td><?= htmlspecialchars($refuel->date) ?></td>
            <td><?= htmlspecialchars($carMap[$refuel->carId]->brand . ' ' . $carMap[$refuel->carId]->model . ' ' . $carMap[$refuel->carId]->regNum) ?></td>
            <td><?= htmlspecialchars($refuel->mileage) ?></td>
            <td><?= htmlspecialchars($refuel->liters) ?></td>
            <td><?= htmlspecialchars($refuel->pricePerLiter) ?></td>
            <td><?= $refuel->isFull ? 'Да' : 'Нет' ?></td>
        </tr>
    <?php endforeach; ?>

</table>