<?php
// include_once("../dbconnect.php");
// session_start();
// $emailCheckUsername=$_SESSION['username'];

// if($_SERVER['REQUEST_METHOD']==='POST'){
//   $email=$_POST['email'];
// $query="update user set email=? WHERE username='$emailCheckUsername'";
// $stmt=mysqli_prepare($conn,$query);
// mysqli_stmt_bind_param($stmt,"s",$email);
// if(mysqli_stmt_execute($stmt)){
//   header("location:changePassword.php");
// }
// }

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
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href="css/ruang-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../chat.css">
  <link rel="stylesheet" href="../css/theme.css">
  <link rel="stylesheet" href="../css/loginStyle.css">
</head>
<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/settingSidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- topbar -->
        <?php include "Includes/settingTopbar.php";?>
<!-- topbar -->


<p>add email</p>















    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>  
    <script src="../scripts/themeChanger.js"></script>
    <script src="../scripts/logoutScript.js"></script>
</body>
</html>