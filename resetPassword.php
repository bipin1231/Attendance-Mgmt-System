<?php
include_once('dbconnect.php');
 if($_GET['secret'])
 {
   $email = base64_decode($_GET['secret']);
// echo $email;
//  $admin='admin';
   if(isset($_REQUEST['submit']))
{
   $pass=$_POST['npass'];
   $confirm_pass=$_POST['cpass'];
   
   if($pass===$confirm_pass){
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

     $query="update user set pass='$hashed_password' where email='$email'";
    // //$result=mysqli_query($conn,$query);
     if(mysqli_query($conn,$query)){
    echo "updated";
        header("location:login.php");
     }

   }
}  
} 
 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="post">
    <div class="login-box">
        <div class="login-header">
            <header>Reset Password</header>
        </div>
        <div class="input-box">
            <input type="password" name="npass" class="input-field" placeholder="new password" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" name="cpass" class="input-field" placeholder="confirm password" autocomplete="off" required>
        </div>
        
        <div class="input-submit">
            <button class="submit-btn" type="submit" name="submit" id="submit"></button>
            <label for="submit">Update</label>
        </div>
        
    </div>
</form>
</body>
</html>
