<?php
session_start();
require_once '../Classes/db.php';
require_once '../Classes/Reservation.php';
require_once '../Classes/vehicle.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = DB::connect();
    
    $vehicle_id = $_POST['vehicle_id'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $user_id = $_SESSION['id'];

    $vehicleObj = new vehicle($db);
    $vehicle = $vehicleObj->getVehicleById($vehicle_id);
    $pricePerDay = $vehicle['price_per_day'];

    $start = new DateTime($date_debut);
    $end = new DateTime($date_fin);
    $diff = $start->diff($end);
    $days = $diff->days;
    if ($days < 1) $days = 1; 

    $total_price = $days * $pricePerDay;


    $reservation = new Reservation($db);
    $reservation->user_id = $user_id;
    $reservation->vehicle_id = $vehicle_id;
    $reservation->start_date = $date_debut;
    $reservation->end_date = $date_fin;
    
    if ($reservation->createReservation()) {
        header("Location: booking-success.php");
    } else {
        header("Location: vehicle-details.php?id=$vehicle_id&error=creation_failed");
    }
    exit();
}
