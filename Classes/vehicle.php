<?php

class vehicle{
    private $vehicle_id;
    private $brand;
    private $model;
    private $pricePerDay;
    private $description;
    private $imagePath;
    private $isAvailable;
    private $createdAt;

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

}