<!--the login php script-->
<!DOCTYPE html>
<html>
<?php
$dbPath = './users.db';

try {
    $pdo = new PDO("sqlite:$dbPath");
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./login.css">
    </head>
    <body>

    </body>
</html>