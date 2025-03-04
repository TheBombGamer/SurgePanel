<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: ./panel/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' href='./css/login.css'>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="authenticate.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login"><hr>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </form>
</body>
</html>