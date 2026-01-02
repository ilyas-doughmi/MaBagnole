<?php
require_once "db.php";

class Reservation {
    private $pdo;
    private $reservation_id;
    private $user_id;
    private $vehicle_id;
    private $start_date;
    private $end_date;
    private $pickup_location;
    private $return_location;
    private $reservation_status;
    private $created_at;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function createReservation() {
        $query = "INSERT INTO reservation (user_id, vehicle_id, start_date, end_date, pickup_location, return_location, reservation_status) 
                  VALUES (:user_id, :vehicle_id, :start_date, :end_date, :pickup_location, :return_location, :status)";
        $stmt = $this->pdo->prepare($query);
        
        try {
            $stmt->execute([
                ':user_id' => $this->user_id,
                ':vehicle_id' => $this->vehicle_id,
                ':start_date' => $this->start_date,
                ':end_date' => $this->end_date,
                ':pickup_location' => $this->pickup_location ?? 'Agence MaBagnole',
                ':return_location' => $this->return_location ?? 'Agence MaBagnole',
                ':status' => 'pending' 
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
