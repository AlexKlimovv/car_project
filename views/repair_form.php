<form method="post">
    <?php if (!empty($errors)): ?>
        <ul style="color: red">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <label>Авто:
        <select name="car_id" required>
            <option value="">Выберите авто</option>
            <?php foreach ($userCars as $car) : ?>
                <option value="<?= $car->id ?>" <?= isset($repair) && $repair->carId == $car->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($car->brand. ' '. $car->model. ' '. $car->regNum) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <label>Километраж:
        <input type="number" name="odometer" value="<?= $repair->odometer ?? '' ?>" required>
    </label><br>
    <label>Описание:
        <textarea name="description" required> <?= $repair->description ?? '' ?></textarea>
    </label><br>
    <label>Сумма услуг по ремонту:
        <input type="number" step="0.01" name="work_cost" value="<?= $repair->workCost ?? '' ?>" >
    </label><br>
    <label>Стоимость з/ч:
        <input type="number" step="0.01" name="parts_cost" value="<?= $repair->partsCost ?? '' ?>" >
    </label><br>

    <button type="submit">Сохранить</button>
</form>