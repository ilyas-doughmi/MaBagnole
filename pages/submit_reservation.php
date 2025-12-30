<?php
// pages/submit_reservation.php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php?redirect=vehicle-details.php?id=" . $_POST['vehicle_id']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id = $_POST['vehicle_id'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $user_id = $_SESSION['user_id']; // Assuming stored in session

    // Validate dates
    if (strtotime($date_debut) >= strtotime($date_fin)) {
        die("Erreur : La date de retour doit être après la date de départ.");
    }

    // Database Connection
    // include '../db.php';

    try {
        // Call Stored Procedure: AjouterReservation
        // $stmt = $pdo->prepare("CALL AjouterReservation(:id_client, :id_vehicule, :date_debut, :date_fin)");
        // $stmt->execute([
        //     ':id_client' => $user_id,
        //     ':id_vehicule' => $vehicle_id,
        //     ':date_debut' => $date_debut,
        //     ':date_fin' => $date_fin
        // ]);

        // Success
        header("Location: booking-success.php");
        exit();

    } catch (PDOException $e) {
        echo "Erreur lors de la réservation : " . $e->getMessage();
    }
}
?>