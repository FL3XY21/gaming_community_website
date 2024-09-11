<?php
require '../includes/config.php'; // Ensure this path is correct

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the deletion query
    $stmt = $pdo->prepare("DELETE FROM contact_submissions WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect to the dashboard after deletion
    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "No ID provided.";
}
?>
