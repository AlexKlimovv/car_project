<?php

class RefuelStorage
{
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addRefuel(Refuel $refuel): bool
    {
        $sql = "INSERT INTO refuels (car_id, mileage, user_id, liters, price_per_liter, is_full, created_at) VALUES (:car_id, :mileage, :user_id, :liters, :price_per_liter, :is_full, :created_at)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'car_id' => $refuel->carId,
            'mileage' => $refuel->mileage,
            'user_id' => $refuel->userId,
            'liters' => $refuel->liters,
            'price_per_liter' => $refuel->pricePerLiter,
            'is_full' => $refuel->isFull,
            'created_at' => $refuel->date
        ]);
    }

    public function getAllByCarId(int $carId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM refuels WHERE car_id = ? ORDER BY created_at DESC");
        $stmt->execute([$carId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($row) {
            return new Refuel(
                $row['id'],
                $row['car_id'],
                (int)$row['mileage'],
                $row['user_id'],
                (float)$row['liters'],
                (float)$row['price_per_liter'],
                (int)$row['is_full'],
                $row['created_at']
            );
        }, $rows);
    }

    public function getAllByUserId($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM refuels WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'map'], $rows);
    }

    public function map(array $row): Refuel {
        return new Refuel(
            $row['id'],
            $row['car_id'],
            (int)$row['mileage'],
            $row['user_id'],
            (float)$row['liters'],
            (float)$row['price_per_liter'],
            (int)$row['is_full'],
            $row['created_at']
        );
    }
}