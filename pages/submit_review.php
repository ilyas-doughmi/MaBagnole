<?php
// pages/submit_review.php
require_once '../includes/guard.php';
require_login();

/*
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id = $_POST['vehicle_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    // Database Connection
    // include '../db.php';

    try {
        // Insert Review
        // $stmt = $pdo->prepare("INSERT INTO Avis (id_client, id_vehicule, note, commentaire, date_avis) VALUES (?, ?, ?, ?, NOW())");
        // $stmt->execute([$user_id, $vehicle_id, $rating, $comment]);

        // Redirect back to vehicle page
        header("Location: vehicle-details.php?id=" . $vehicle_id . "&review_submitted=1");
        exit();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>