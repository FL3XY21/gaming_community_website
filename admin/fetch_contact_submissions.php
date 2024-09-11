<?php
require '../includes/config.php'; // Ensure this path is correct

// Fetch contact submissions from the database
function fetchContactSubmissions($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM contact_submissions");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Call the function and store the result
$submissions = fetchContactSubmissions($pdo);
?>
