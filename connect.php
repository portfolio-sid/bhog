<?php
require_once "config.php";

if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $detail = $_POST['detail'];

    if(empty($firstName) || empty($lastName) || empty($email) || empty($category) || empty($detail)){
        header('location:contact.php?error');
    }
 
}


$sql = "INSERT INTO contact (firstName, lastName, email, category, detail) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if($stmt){
    mysqli_stmt_bind_param($stmt, "sssss",  $firstName, $lastName, $email, $category, $detail);

    if(mysqli_stmt_execute($stmt)){
        header("location:contact.php?success");
    }
    else{
        echo "Something went wrong ... connot redirect!";
    }

}
mysqli_stmt_close($stmt);
mysqli_close($conn);


?>