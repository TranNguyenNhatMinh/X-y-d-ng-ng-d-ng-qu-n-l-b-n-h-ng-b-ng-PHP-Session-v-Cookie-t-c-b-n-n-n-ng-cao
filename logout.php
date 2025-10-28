<?php
session_start();
session_unset();
session_destroy();

// Xóa cookie
setcookie('user_login', '', time() - 3600, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
    <h2>You have successfully logged out.</h2>
    <a href="login.php">Login again</a>
</body>
</html>
