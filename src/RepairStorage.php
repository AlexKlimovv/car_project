<?php
require_once 'Repair.php';
class RepairStorage
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Repair $repair): void // сохранение нового ремонта в базу
    {
        $stmt = $this->pdo->prepare("INSERT INTO repairs (car_id, odometer, description, work_cost, parts_cost, created_at, edited) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $repair->carId,
            $repair->odometer,
            $repair->description,
            $repair->workCost,
            $repair->partsCost,
            $repair->createdAt,
            $repair->edited ? 1 : 0,
        ]);
    }

    public function getByCarId(int $carId): array // Получение ремонтов по конкретной машине
    {
        $stmt = $this->pdo->prepare("SELECT * FROM repairs WHERE car_id = ? ORDER BY created_at DESC");
        $stmt->execute([$carId]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($row) { //Проходит по массиву и возвращает новый массив, где к каждому элементу применена функция.
            return new Repair(
                $row['id'],
                $row['car_id'],
                $row['odometer'],
                $row['description'],
                (float)$row['work_cost'],
                (float)$row['parts_cost'],
                $row['created_at'],
                (bool)$row['edited']
            );
        }, $rows);
    }

    /**
     * @return PDO
     */
    public function getByUserId(int $userId): array {
        $sql = "SELECT r.* FROM repairs r JOIN cars c ON r.car_id = c.id WHERE c.user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'map'], $rows);
    }

    public function map(array $row): Repair {
        return new Repair(
          $row['id'],
          $row['car_id'],
          $row['odometer'],
          $row['description'],
          (float)$row['work_cost'],
          (float)$row['parts_cost'],
          $row['created_at'],
          (bool)$row['edited'],
        );
    }
}