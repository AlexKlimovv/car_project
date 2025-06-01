<?php

class Refuel
{
    public ?int $id;
    public int $carId;
    public int $mileage;
    public  int $userId;
    public float $liters;
    public float $pricePerLiter;
    public int $isFull;

    public string $date;
    public function __construct($id, $carId, $mileage, $userId, $liters, $pricePerLiter, $isFull, $date)
    {
        $this->id = $id;
        $this->carId = $carId;
        $this->mileage = $mileage;
        $this->userId = $userId;
        $this->liters = $liters;
        $this->pricePerLiter = $pricePerLiter;
        $this->isFull = $isFull;
        $this->date = $date ?? date('Y-m-d H:i:s');
    }
}