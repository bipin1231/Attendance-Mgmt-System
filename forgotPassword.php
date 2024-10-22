<?php 
include_once('dbconnect.php');
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
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
            <header>Forgot Password</header>
        </div>
        <div class="input-box">
            <input type="text" class="input-field" placeholder="Email" name="email" autocomplete="off" required>
        </div>
       
        
        <div class="input-submit">
            <button class="submit-btn" id="submit"></button>
            <label for="submit">Send</label>
        </div>
        
    </div>
</form>
</body>
</html>

<?php
                $message='';
              if(isset($_POST)){
             if(isset($_POST['email'])){
                $email=$_POST['email'];
               
$query="SELECT * FROM user WHERE email=?";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)>0){  
  
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/project/New folder (2)/Project---/resetPassword.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';
  
    $mail = new PHPMailer(true);
  
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='bipinadhikari739@gmail.com';
    $mail->Password='icvk cbbq snqr dcph';
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
      $mail->Port       = 465;   
  
      $mail->setFrom('bipinadhikari739@gmail.com');
      $mail->addAddress($email);
  
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Reset Password';
      $mail->Body    = $message;
     $mail->send();
}
}
              }

			?>

                            