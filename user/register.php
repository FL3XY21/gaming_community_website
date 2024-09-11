<?php
session_start();
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = 'INSERT INTO users (username, password,email) VALUES (?, ?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $hashedPassword,$email]);

    // Optionally, redirect or provide a success message
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
    <h1>Register</h1>
    <form action="register.php" method="POST">
    <div class="input-box">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br></div>
        <div class="input-box">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br></div>
        <label for="email">Email:</label>
        <div class="input-box">
        <input type="email" id="email" name="email" required><br></div>
        <input type="submit" class="btn" value="Register">
    </form></div> 
</body>
</html>
