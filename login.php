<?php
include 'partial/partial.php';

$loginalert = false;
$loginerror = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connecting to the database
    include 'partial/database.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username exists
    $usernamesql = "SELECT * FROM users WHERE username='$username'";
    $user_result = mysqli_query($conn, $usernamesql);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        // Verify if the username and password match
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $select_result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($select_result) == 1) {
            $loginalert = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: welcome.php"); // Redirect to welcome.php page
            exit; // Stop further execution
          } 
          else
          {
            $loginerror = "Password is incorrect";
          }
    } 
    else {
    $loginerror = "Username is incorrect";
         }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Login</h2>
    
    <?php 
    // Success alert message
    if ($loginalert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>You are logged in successfully!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <?php 
    // Error alert message
    if ($loginerror) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>' . htmlspecialchars($loginerror) . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
 
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
</div>
</body>
</html>
