<?php
class CarStorage
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Car $car): bool {
        $sql = "INSERT INTO cars (brand, model, vin, regNum, yearOfManufacture, user_id) 
        VALUES (:brand, :model, :vin, :regNum, :year, :user_id)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'brand' => $car->brand,
            'model' => $car->model,
            'regNum' => $car->regNum,
            'vin' => $car->vin,
            'year' => $car->yearOfManufacture,
            'user_id' => $car->userId
        ]);

    }

    public function getAllByUser(int $userId): array
    {
        $sql = "SELECT * FROM cars WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cars = [];
        foreach ($rows as $row) {
            $cars[] = new Car(
                (int)$row['id'],
                $row['brand'],
                $row['model'],
                $row['regNum'],
                $row['vin'],
                $row['yearOfManufacture'],
                (int)$row['user_id']
            );
        }
        return $cars;
    }

    public function get(int $id): ? Car
    {
        $sql = "SELECT * FROM cars WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Car(
                (int)$row['id'],
                $row['brand'],
                $row['model'],
                $row['regNum'],
                $row['vin'],
                $row['yearOfManufacture'],
                (int)$row['user_id']
            );
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM cars WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    public function update(int $id, Car $car): bool
    {
        $sql = "UPDATE cars SET brand = :brand, model = :model, vin = :vin, 
                regNum = :regNum, yearOfManufacture = :year WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':brand' => $car->brand,
            ':model' => $car->model,
            ':vin' => $car->vin,
            ':regNum' => $car->regNum,
            ':year' => $car->yearOfManufacture
        ]);
    }
}