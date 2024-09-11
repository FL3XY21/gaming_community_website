<?php
$password = 'admin_password'; // Replace with the actual password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo 'Hashed Password: ' . $hashed_password;
?>
