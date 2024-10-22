<?php
include_once("../dbconnect.php");
session_start();
$emailCheckUsername=$_SESSION['username'];

if($_SERVER['REQUEST_METHOD']==='POST'){
  $email=$_POST['email'];
$query="update user set email=? WHERE username='$emailCheckUsername'";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$email);
if(mysqli_stmt_execute($stmt)){
  header("location:changePassword.php");
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
</body>
</html>