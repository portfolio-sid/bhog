<?php
require_once "config.php";
session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) {
  header ("Location: login.php");
  
  }
else{
  
  $customer = $_SESSION['username'];
  

  $total = $_POST['total'];
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


  if($conn == false){
    dir('Error: Cannot connect');
  }
  
$sql = "INSERT INTO orders (customer, total) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if($stmt){
    mysqli_stmt_bind_param($stmt, "si",$customer, $total);

    
    mysqli_stmt_execute($stmt);

}
mysqli_stmt_close($stmt);
mysqli_close($conn);
  echo "<script>localStorage.removeItem('CART')</script>";
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhog- Indian Fine Dining</title>
    <style>
      .details{
        margin: 200px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav>
      <div class="logo">Bhog</div>
      
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="cart.html">Cart</a></li>
        <li><a href="signup.html">Sign Up</a></li>
        <li><a href="reviews.html">Reviews</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>
    <div class="details">
      <h1><?php echo "Hello ". $_SESSION['username']?></h1>
      <p>Your order has been placed.</p>
    </div>
    

  </body>
</html>