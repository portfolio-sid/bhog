<?php

session_start();


if(isset($_SESSION['username']))
{
    header("location: cart.html");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = ""; 

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            header("location: cart.html");
                            
                        }
                    }

                }

    }
}    


}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylelogreg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhog- Indian Fine Dining</title>
  </head>
  <body>
    <nav>
      <div class="logo">Bhog</div>
      <ul>
      <li><a href="index.html">Home</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="signup.html">Sign Up</a></li>
        <li><a href="reviews.html">Reviews</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
</ul>
    </nav>

<div class="container">
<h3>Please login here</h3>
<form action="" method="post">
<div class="">
    <label for="email">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div>
  <label for="password" class="form-label">Password</label>
    <input type="password" name="password">
  </div>
  <button type="submit" class="submit">Submit</button>
</form>
</div>
   
  </body>
</html>