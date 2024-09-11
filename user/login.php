<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
    <h1>Login</h1>
    <form id="loginForm" action="login_process.php" method="POST">
        <div class="selector">
        <label for="user_type">Select User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="user">USER</option>
            <option value="admin">ADMIN</option>
        </select><br></div>
        <div class="input-box">
        <label for="username"><i class='bx bxs-user'></i></label>
        <input type="text" id="username" name="username" placeholder="Username"  required><br></div>

        <div class="input-box">
        <label for="password"><i class='bx bxs-lock-alt' ></i></label>
        <input type="password" id="password" name="password"placeholder="Password" required><br></div>

        <input type="submit"  class="btn" value="Login">
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="register">
    <a href="register.php">Don't have an account? Register here.</a></div></div>
</body>
</html>
