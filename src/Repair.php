<?php

class Repair
{
    public ?int $id;
    public int $carId;
    public int $odometer;
    public string $description;
    public float $workCost;
    public float $partsCost;
    public string $createdAt;
    public bool $edited;

    public function __construct(
        ?int $id,
        int $carId,
        int $odometer,
        string $description,
        float $workCost,
        float $partsCost,
        string $cratedAt,
        bool $edited = false
    ) {
        $this->id = $id;
        $this->carId = $carId;
        $this->odometer = $odometer;
        $this->description = $description;
        $this->workCost = $workCost;
        $this->partsCost = $partsCost;
        $this->createdAt = $cratedAt;
        $this->edited = $edited;
    }
}