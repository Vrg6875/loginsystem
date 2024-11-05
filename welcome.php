<?php
include 'partial/partial.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
        echo $_SESSION['username']; 
        ?>
    </title>
</head>
<body>
    <h1>This is the Welcome Page</h1>
    <?php 
    echo '<h3>' . $_SESSION['username'] . '</h3>';
     ?>
</body>
</html>
