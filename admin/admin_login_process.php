<?php
session_start();

// Hardcoded credentials
$admin_username = 'admin'; // Hardcoded admin username
$admin_password = '123456'; // Hardcoded admin password

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if fields are not empty
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo 'Please fill in all fields.';
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = $username;
        header('Location: ../admin/admin_dashboard.php');
        exit();
    } else {
        echo 'Invalid admin username or password!';
    }
}
?>
