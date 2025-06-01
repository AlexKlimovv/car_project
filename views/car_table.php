<?php if (!empty($cars)) : ?>
    <h2>Ваши машины:</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Марка:</th>
            <th>Модель:</th>
            <th>Гос.Номер:</th>
            <th>Год:</th>
            <th>VIN:</th>
            <th>Действие</th>
        </tr>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car->brand) ?></td>
                <td><?= htmlspecialchars($car->model) ?></td>
                <td><?= htmlspecialchars($car->regNum) ?></td>
                <td><?= htmlspecialchars($car->yearOfManufacture) ?></td>
                <td><?= htmlspecialchars($car->vin) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="<?= $car->id ?>">
                        <button type="submit" name="delete" value="<?= $car->id ?>" onclick="return confirm('Вы уверены, что хотите удалить это авто и все связанные с ним данные?')">Удалить</button>
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
