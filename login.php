<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>


<?php
session_start();
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username == 'admin' && $password == '123'){
        $_SESSION['username'] = 'admin';
        echo "Login successful. Welcome, " . $_SESSION['username'] . "!";
        setcookie('userlogin', $_SESSION['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
        header('Location: store.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
    
    
}