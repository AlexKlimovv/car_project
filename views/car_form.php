<form method="post">
            <input type="hidden" name="editIndex" value="<?= $editIndex ?? '' ?>">
            Марка: <input type="text" name="brand" value="<?= $editCar->brand ?? '' ?>"> <br>
            Модель: <input type="text" name="model" value="<?= $editCar->model ?? '' ?>"> <br>
            VIN: <input type="text" name="vin" value="<?= $editCar->vin ?? '' ?>"> <br>
            Гос.Номер: <input type="text" name="regNum" value="<?= $editCar->regNum ?? '' ?>"> <br>
            Год: <input type="text" name="yearOfManufacture" value="<?= $editCar->yearOfManufacture ?? '' ?>"> <br>
            <button type="submit"><?= $editCar ? 'Сохранить' : 'Добавить машину' ?></button>
</form>