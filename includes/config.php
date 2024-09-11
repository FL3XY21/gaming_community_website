<?php
$host = 'localhost'; 
$dbname = 'gaming_website'; 
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password, use empty string if no password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
    exit;
}
?>
