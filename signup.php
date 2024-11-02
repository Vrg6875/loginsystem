<?php
include 'partial/partial.php';
$show=false;
$showalert = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    // Connecting to the database
    include 'partial/database.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["confirm_password"];

    //check username exist
    $existsql="SELECT * FROM users where username='$username'";
    $existresult=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($existresult);

    if($num>0){
        $show="username already exists";

    }
  
    else{

        if ($password == $cpassword)
        {
           $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
           $insert_result = mysqli_query($conn, $sql);
           
           if ($insert_result) 
           {
               $showalert = true;
           }
       }
       else
       {
        $showerror="password do not match";
        }    

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Signup</h2>
    
    <?php 
// Success Alert message
if ($showalert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Your account has been created. Please <a href="login.php">log in</a>!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
    <?php 
// Alert message
if ($show) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>'.$show.'</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>


  <?php 
    // error Alert message
    if ($showerror) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>'.$showerror.'</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
 
    <form action="signup.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
</body>
</html>
