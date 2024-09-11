<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Ensure ID is an integer
    
    // Prepare and execute the SQL DELETE query
    $stmt = $pdo->prepare('DELETE FROM tournaments WHERE tournament_id = ?');
    if ($stmt->execute([$id])) {
        // Redirect to the manage tournaments page
        header('Location: manage_tournaments.php');
        exit();
    } else {
        // Handle SQL error
        echo "SQL error: " . implode(", ", $stmt->errorInfo());
    }
} else {
    echo "No id parameter in URL.";
}
?>
