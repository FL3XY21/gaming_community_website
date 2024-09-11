<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
    <h1>Admin Login</h1>
    <form id="adminLoginForm" action="admin_login_process.php" method="POST">
    <div class="input-box">
        <label for="admin_username">Username:</label>
        <input type="text" id="admin_username" name="username" required><br></div>
        <div class="input-box">
        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="password" required><br></div>
        <input type="submit" class="btn"  value="Login">
    </form></div>
</body>
</html>
