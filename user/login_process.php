<?php
session_start();
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user_type === 'admin') {
        // Admin login process
        $admin_username = 'admin'; // Hardcoded admin username
        $admin_password = '123456'; // Hardcoded admin password
        
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['admin'] = true;
            header('Location: ../admin/admin_dashboard.php');
            exit();
        } else {
            $error = 'Invalid admin username or password!';
        }
    } else {
        // User login process
        $sql = 'SELECT * FROM users WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['verified']) {
                $_SESSION['user'] = $user['username'];
                header('Location: index.php');
                exit();
            } else {
                $error = 'Your account is not verified. Please contact support.';
            }
        } else {
            $error = 'Invalid username or password!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="../js/scripts.js" defer></script>
    <style>
        body{
            display: flex;
            justify-content: center;   
             align-items: center;
            min-height: 100vh;
            background: url('bg.jpg') no-repeat;
             background-size: cover;
             background-position: center;
        }
        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px 40px;
            text-align: center;
        }

        .wrapper h2 {
            font-size: 30px;
            margin-bottom: 20px;

        }

        .wrapper .selector{
             margin-top: 20px;
            font-size: 20px;
        }

        .wrapper .selector select{
            size: 20px;
        }

        .wrapper .color{
            color: #fff;
            font-weight: 1000px;
        }

        .wrapper form {
            display: flex;
            flex-direction: column;
        }

        .wrapper label {
            margin: 10px 0 5px;
            font-size: 16px;
        }

        .wrapper input[type="text"], .wrapper input[type="password"], .wrapper select {
            width: 100%;
            height: 50px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .wrapper input[type="submit"] {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .wrapper a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            display: inline-block;
        }

        .wrapper a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #fff; /* Red for errors */
            font-size: 20pxpx;
            margin-top: 10px;
            font: weight 1000px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <h2>Login</h2>
        <form id="loginForm" action="login_process.php" method="POST">
            <div class="selector"><label for="user_type">Select User Type:</label>
            <select id="user_type" name="user_type" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br></div>
            <div class="color">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br></div>
            <div class="color">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br></div>

            <input type="submit" value="Login">
        </form>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <a href="register.php">Don't have an account? Register here.</a>
    </div>
</body>
</html>
