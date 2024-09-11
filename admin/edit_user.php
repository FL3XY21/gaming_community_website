<?php
session_start();
require '../includes/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $verified = isset($_POST['verified']) ? 1 : 0;

        try {
            $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, verified = ? WHERE id = ?');
            $stmt->execute([$username, $email, $verified, $user_id]);
            header('Location: manage_users.php');
            exit();
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }

    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
} else {
    header('Location: manage_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/admineu.css">
</head>
<body>
    <div class="wrapper">
        <h1>Edit User</h1>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="edit_user.php?id=<?php echo urlencode($user_id); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

            <label for="verified">Verified:</label>
            <input type="checkbox" id="verified" name="verified" <?php echo $user['verified'] ? 'checked' : ''; ?>><br>

            <input type="submit" value="Save Changes">
        </form>
        <a href="manage_users.php">Back to Manage Users</a>
    </div>
</body>
</html>
