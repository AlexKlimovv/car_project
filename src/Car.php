<?php
class Car
{
    public ?int $id;
    public string $brand;
    public string $model;
    public string $regNum;
    public int $yearOfManufacture;
    public string $vin;
    public int $userId;

    public function __construct($id, $brand, $model, $regNum, $vin, $yearOfManufacture, $userId)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->regNum = $regNum;
        $this->vin = $vin;
        $this->yearOfManufacture = $yearOfManufacture;
        $this->id = $id;
        $this->userId = $userId;
    }
}