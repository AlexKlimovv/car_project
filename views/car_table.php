<?php if (!empty($cars)) : ?>
    <h2>Ваши машины:</h2>
    <table>
        <tr>
            <th>Марка:</th>
            <th>Модель:</th>
            <th>VIN:</th>
            <th>Гос.Номер:</th>
            <th>Год:</th>
            <th>Действие</th>
        </tr>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car->brand) ?></td>
                <td><?= htmlspecialchars($car->model) ?></td>
                <td><?= htmlspecialchars($car->vin) ?></td>
                <td><?= htmlspecialchars($car->regNum) ?></td>
                <td><?= htmlspecialchars($car->yearOfManufacture) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="<?= $car->id ?>">
                        <button type="submit">Удалить</button>
                    </form>

                    <form method="post">
                        <input type="hidden" name="edit" value="<?= $car->id ?>">
                        <button type="submit">Редактировать</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
