<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('UPDATE users SET verified = FALSE WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: manage_users.php');
exit();
?>
