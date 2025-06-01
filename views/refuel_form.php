<h2>Ваши заправки:</h2>

<?php if (!empty($errors)): ?>
    <ul style="color:red">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="/PhpstormProjects/car_project/controller/refuel_controller.php">
    <label>Выберите авто:
        <select name="car_id" onchange="this.form.submit()>
            <option value="">Все авто</option>
            <?php foreach ($userCars as $car): ?>
                <option value="<?= $car->id ?>" <?= (isset($refuel) && $refuel && $refuel->carId == $car->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($car->brand . ' ' . $car->model . ' ' . $car->regNum) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Километраж: <input type="text" name="mileage" value="<?= $refuel->mileage ?? '' ?>"></label><br>
    <label>Литров: <input type="text" name="liters" value="<?= $refuel->liters ?? '' ?>"></label><br>
    <label>Цена за литр: <input type="text" name="pricePerLiter" value="<?= $refuel->pricePerLiter ?? '' ?>"></label><br>
    <label>Полный бак: <input type="checkbox" name="isFull" <?= (isset($refuel) && $refuel->isFull) ? 'checked' : '' ?>></label><br>

    <button type="submit">Сохранить</button>
</form>


