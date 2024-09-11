<?php
session_start();
require '../includes/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$user_id]);
        header('Location: manage_users.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
} else {
    header('Location: manage_users.php');
    exit();
}
?>
