<?php
session_start();
require '../includes/config.php'; // Ensure this path is correct

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables
    $name = '';
    $email = '';
    $issue = '';
    $message = '';

    // Check if each field is set and sanitize
    if (isset($_POST['name'])) {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    if (isset($_POST['email'])) {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    if (isset($_POST['issue'])) {
        $issue = htmlspecialchars(trim($_POST['issue']));
    }

    if (isset($_POST['message'])) {
        $message = htmlspecialchars(trim($_POST['message']));
    }

    // Basic validation (you might want to add more validation here)
    if (empty($name) || empty($email) || empty($message)) {
        echo 'All fields are required.';
        exit();
    }

    // Insert the data into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, issue, message, created_at) VALUES (:name, :email, :issue, :message, NOW())");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':issue' => $issue,
            ':message' => $message
        ]);
        echo 'Contact submission successful!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
