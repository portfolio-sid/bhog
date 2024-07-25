<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){


    if(empty(trim($_POST['username']))){
        $username_err = "Username cannot be blank";
    }
    else{ 
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_username);


            $param_username = trim($_POST['username']);


            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken";
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);



if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 8){
    $password_err = "Password cannot be less than 8 characters";
}
else{
    $password = trim($_POST['password']);
}


if((trim($_POST['confirm_password'])) != (trim($_POST['password']))){
    $password_err = "Password should match";
}


if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);


        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);


        if(mysqli_stmt_execute($stmt)){
            header("location: login.php");
        }
        else{
            echo "Something went wrong ... connot redirect!";
        }

    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

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
        <li><a href="index.html" class="">Home</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="cart.html">Cart</a></li>
        <li><a href="signup.html">Sign Up</a></li>
        <li><a href="reviews.html">Reviews</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>

<div class="container">
<h3>Please register here</h3>
<form action="" method="post">
  <div class="">
    <label for="email">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div>
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password">
  </div>
  <div class="">
    <label for="passwordrepeat">Confirm Password</label>
    <input type="password" name="confirm_password">
  </div>
  
  <button type="submit" class="submit">Submit</button>
</form>
</div>

  </body>
</html>