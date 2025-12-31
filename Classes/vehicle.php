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

    public function getVehicles()
    {
        $query = "SELECT v.*, c.category_name 
                  FROM vehicle v 
                  LEFT JOIN category c ON v.category_id = c.category_id";
        $stmt = $this->pdo->query($query);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = count($vehicles);

        return [
            "vehicles" => $vehicles,
            "count" => $count
        ];
    }

}