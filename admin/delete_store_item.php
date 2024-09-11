<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM store_items WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: manage_store.php');
exit();
?>
