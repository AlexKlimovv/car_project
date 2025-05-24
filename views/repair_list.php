<h2>Ремонты</h2>
<form method="get" action="/PhpstormProjects/car_project/repairs.php">
    <label>Выберите авто:
        <select name="car_id" onchange="this.form.submit()">
            <option value="">Все авто</option>
                <?php foreach ($userCars as $car): ?>
                    <option value="<?= $car->id ?>" <?= ($selectedCarId == $car->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($car->brand . ' ' . $car->model . ' ' . $car->regNum) ?>
                    </option>
            <?php endforeach; ?>
        </select>
    </label>
</form>
<a href="/PhpstormProjects/car_project/controller/repairs_controller.php?action=create">Добавить ремонт</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Авто</th>
        <th>Дата добавления</th>
        <th>Километраж</th>
        <th>Описание</th>
        <th>Стоимость услуг</th>
        <th>Затраты на з/ч</th>
    </tr>
    <?php foreach ($repairs as $repair): ?>
    <tr>
        <td> <?= htmlspecialchars($carMap[$repair->carId]->brand. ' ' . $carMap[$repair->carId]->model . ' ' . $carMap[$repair->carId]->regNum) ?></td>
        <td> <?= htmlspecialchars($repair->createdAt) ?></td>
        <td> <?= htmlspecialchars($repair->odometer) ?></td>
        <td> <?= nl2br(htmlspecialchars($repair->description)) ?></td>
        <td> <?= htmlspecialchars($repair->workCost) ?></td>
        <td> <?= htmlspecialchars($repair->partsCost) ?></td>
    </tr>
    <?php endforeach; ?>
</table>