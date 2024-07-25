<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylecontact.css">
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
        <li><a href="cart.html">Cart</a></li>
        <li><a href="signup.html">Sign Up</a></li>
        <li><a href="reviews.html">Reviews</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php" class="activepage">Contact Us</a></li>
      </ul>
    </nav>
    <form action="connect.php" method="post">
      <?php
        $msg = "";
        if(isset($_GET['error'])){
          $msg = "Fill in the details";
          echo '<div class="msg red">'.$msg.'</div>';
        }
        if(isset($_GET['success'])){
          $msg = "Successful";
          echo '<div class="msg green">'.$msg.'</div>';
        }
      ?>
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" placeholder="John" required><br><br>
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="Doe" required><br><br>
      <label for="email">Email id:</label>
      <input type="email" id="email" name="email" placeholder="id@domain.com" required><br><br>



      <label for="category">Choose a category:</label>
      <select name="category" id="category" required>
          <option value="" selected disabled hidden>Select an Option</option>
          <option value="doubt">Doubt</option>
          <option value="complaint">Complaint</option>
          <option value="request">Request</option>
      </select><br><br>
      <label for="detail">Subject</label>
      <textarea id="detail" name="detail" placeholder="Write something..." style="height:200px" required></textarea>
      <br>

      <button type="submit" name="submit" class="submit">Submit</button>
      <input type="reset">
  </form>

  </body>
</html>