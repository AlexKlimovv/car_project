<form method="post" action="/PhpstormProjects/car_project/car_controller.php">
    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <input type="hidden" name="editIndex" value="<?= $editIndex ?? '' ?>">
            Марка: <input type="text" name="brand" value="<?= $editCar->brand ?? '' ?>"> <br>
            Модель: <input type="text" name="model" value="<?= $editCar->model ?? '' ?>"> <br>
            VIN: <input type="text" name="vin" value="<?= $editCar->vin ?? '' ?>" maxlength="17" pattern="[A-HJ-NPR-Z0-9]{17}" title="17 символов: заглавные буквы и цифры без I, O, Q"> <br>
            Гос.Номер: <input type="text" name="regNum" value="<?= $editCar->regNum ?? '' ?>"> <br>
            Год: <input type="text" name="yearOfManufacture" value="<?= $editCar->yearOfManufacture ?? '' ?>"> <br>
            <button type="submit"><?= $editCar ? 'Сохранить' : 'Добавить машину' ?></button>
</form>