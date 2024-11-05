<?php
// Database connectivity
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Not connected to database: " . mysqli_connect_error());
}
// else {
//     echo "Connected to database successfully<br>";
// }
?>