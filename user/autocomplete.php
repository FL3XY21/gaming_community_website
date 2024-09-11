<?php
require '../includes/config.php';

if (isset($_GET['query'])) {
    $query = trim($_GET['query']);
    $stmt = $pdo->prepare("SELECT name FROM games WHERE name LIKE ?");
    $searchTerm = "%$query%";
    $stmt->execute([$searchTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($results);
}
?>
