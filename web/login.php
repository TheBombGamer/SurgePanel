<!DOCTYPE html>
<html>
<?php
$dbPath = './users.db';

$db = new SQLite3($dbPath);

if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$db->exec($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $db->lastErrorMsg();}}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($user = $result->fetchArray(SQLITE3_ASSOC)) {
        if (password_verify($password, $user['password'])) {
            header('Location: panel.php');
            exit;
        } else {
            echo "Invalid username or password.";}
    } else {
        echo "Invalid username or password.";}}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login and Register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <h2>Register</h2>
    <form method="POST" action="">
        <label for="register-username">Username:</label>
        <input type="text" id="register-username" name="username" required>
        <br>
        <label for="register-password">Password:</label>
        <input type="password" id="register-password" name="password" required>
        <br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>