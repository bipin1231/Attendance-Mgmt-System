<?php
include_once('dbconnect.php');
$username=$password='';
$username_err=$password_err='';
session_start();
if(!isset($_SESSION['username'])){
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];
     /* 
    $query="SELECT * FROM info WHERE username=? AND pass=?";
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"ss",$username,$password);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($result);


    if(mysqli_num_rows($result)===1){
        echo "login successful";
        $user_type=$row['user_type'];
        header("location:".$user_type."/".$user_type."Pannel.php");
    }
*/

$query="SELECT * FROM user WHERE username=?";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);

// if(isset($_SESSION['user_type'])){
//     $user_type=$_SESSION['user_type'];
//     header("location:".$user_type."/".$user_type."Pannel.php");
//     echo $user_type;
// }
if(mysqli_num_rows($result)===1){
    if($password==$row['pass'] || password_verify($password,$row['pass'])){
        $user_type=$row['userType'];
       
        $_SESSION['username']=$username;
        $_SESSION['password']=$row['pass'];
        $_SESSION['user_type']=$user_type;
        header("location:".$user_type."/".$user_type."Pannel.php");
    }
    else{
        echo "<div class='alert alert-danger'>
                    password does not match
      </div>";
    }   
}else{
    echo "<div class='alert alert-danger'>
    username does not match
</div>";
}
}
}else{
    $user_type=$_SESSION['user_type'];
    header("location:".$user_type."/".$user_type."Pannel.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/attnlg.jpg" rel="icon">
    <title>Attendance - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginStyle.css">
    <link rel="stylesheet" href="css/theme.css">
</head>
<body class="main-body" id="Home">
    <div class="header">
        <h3>Online Attendance Management System</h3>
        <span class="material-icons openNavBar" onclick="openNav()">menu</span>
        <div class="loginNavBar" id="navBarList">
            <ul>
                <li><a href="#Home">Home</a></li>
                <!-- <li><a href="#aboutUs">About Us</a></li> -->
                <li><button class="login-btn">Log In</button></li>
                <div class="mode-close">
                    <div id="mode-changer">
                        <i class="fa fa-moon dark-mode"></i>
                        <i class="fa fa-sun dark-mode"></i>  
                    </div>
                    <span class="material-icons closeNavBar">close</span>
                </div>
            </ul>
        </div>
    </div>


    <div class="caption">
        <div class="typewriter">
            <p class="title-a">Attend Today, Achieve Tomorrow</p>
        </div>
    </div>


    <div class="content">
        <div class="features">
            <p><i class="fas fa-check mr-2"></i>Subject-wise Attendance</p>
            <p><i class="fas fa-check mr-2"></i>Generate Attendance Sheet</p>
            <p><i class="fas fa-check mr-2"></i>Generate Report</p>
            <p><i class="fas fa-check mr-2"></i>User-friendly UI</p>
        </div>
        <div class="bg-img-container">
            <img src="img/welcome_page_bg2.png" class="bg-img">
        </div>
    </div>




    <!-- <div class="about-us" id="aboutUs">
        <p class="about-us-title">About Us</p>
        <p>
            <b>Our Goal:</b> To help 
        </p>
    </div> -->


    <!-- ----------------------------------popup-login-form------------------------------------------ -->
    <div class="popupMenu">
        <span class="material-icons closePopup">close</span>
        <div class="form-box">
            <div class="form-header">
                <h2>Login</h2>
                <span class="material-icons login-logo">
                    account_circle
                </span>
            </div>
            <form action="" method="post">
                    <div class="input-field">
                        <i class="fa fa-user"></i>
                        <input type="text" name="username" required>
                        <label>Username</label>                     
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" required>
                        <label>Password</label>                     
                    </div>
                    
                    <div class="rem-for">
                        <label><input type="checkbox">Remember me</label>
                        <a href="forgotPassword.php">Forgot Password?</a>
                    </div>
                    <button type="submit" class="form-login-btn" name="login">Log In</button>
            </form>
        </div>
    </div>
    


    <script src="scripts/loginScript.js"></script>
    <script src="scripts/themeChanger.js"></script>
    <script>
        $(window).scroll(function(){
            $('.header').toggleClass('scrolled', $(this).scrollTop()>50)
        });

        $(document).ready(function(){
            $(".openNavBar").click(function(){
                $(".loginNavBar").animate({
                    right: '0',
                }, 300,);
            });
        });
        $(document).ready(function(){
            $(".closeNavBar").click(function(){
                $(".loginNavBar").animate({
                    right: '-200px',
                }, 300,);
            });
        });
    </script>

</body>
</html>