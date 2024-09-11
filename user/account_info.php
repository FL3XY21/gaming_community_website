<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['user'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Account Information</h1>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Account Created:</strong> <?php echo htmlspecialchars($user['account_creation']); ?></p>
    <p><strong>Verified:</strong> <?php echo $user['verified'] ? 'Yes' : 'No'; ?></p>
</body>
</html>
