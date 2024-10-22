<?php
include_once("../dbconnect.php");
session_start();
$emailCheckUsername=$_SESSION['username'];



$correct=$username=$passowrd=$newpassword=$cpassword='';

$ncPass='';
$passwordMatch='';
$userMatch='';

if($_SERVER['REQUEST_METHOD']==='POST'){
  
  $username=$_POST['username'];
  $password=$_POST['password'];
   $newpassword=$_POST['newpassword'];
   $cpassword=$_POST['cpassword'];
  
$query="SELECT * FROM user WHERE username=?";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)===1){

if($password==$row['pass'] || password_verify($password,$row['pass'])){
  
     if($newpassword===$cpassword){
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
    $query="update user set pass=? where username='$username'";

    $stmt=mysqli_prepare($conn,$query);
     mysqli_stmt_bind_param($stmt,"s",$hashed_password);
   
     if(mysqli_stmt_execute($stmt)){
 
       header("location:adminPannel.php?hello='hello'.php");
      
     
     }
  
    }else{
      $ncPass=1;
    } 

  }
  else{
   $passwordMatch=1;
  } 
 
}else{
  $userMatch=1;
}


}

?>
<?php 

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
<?php include 'includes/title.php';?>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.css" rel="stylesheet">
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
        <!-- TopBar -->
       <?php  include "Includes/settingTopbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color: var(--textColor);">Change Password</h1>
           
          </div>
          <!------------------------- new and confirm doesnot match  ---------------------------------------------->
          <?php
        if($ncPass===1){

          ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>New and Confirm password doesnot match</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
        }
        ?>
          <!------------------------- password doesnot match  ---------------------------------------------->
          <?php
        if($passwordMatch===1){

          ?>
      <div class='alert alert-danger'>
    password does not match
  </div>
      <?php
        }
        ?>
          <!------------------------- username doesnot match  ---------------------------------------------->
          <?php
        if($userMatch===1){

          ?>
      <div class='alert alert-danger'>
    Username does not match
  </div>
      <?php
        }
        ?>

<?php
$checkEmailQuery="select email from user where username='$emailCheckUsername'";
$Emailresult=mysqli_query($conn,$checkEmailQuery);
$num=mysqli_num_rows($Emailresult);

$row=mysqli_fetch_assoc($Emailresult);

if(empty($row['email'])){
  

?>

<div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 
                </div>
                <div class="card-body">
                  <form method="post" action="addEmail.php">
                   <div class="form-group row mb-3">
                        
                    </div>
                     <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Email<span class="text-danger ml-2"></span></label>
                        <input required type="email" class="form-control" name="email"  id="exampleInputFirstName" >
                        </div>
                      
                    </div>
                    
                    
                    <button type="submit" name="change" class="btn btn-primary">Add</button>
                      
                  </form>
                 
                </div>
              </div>

           

        </div>
        <!---Container Fluid-->
      </div>

<?php }else{
?>


          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 
                </div>
                <div class="card-body">
                  <form method="post" action="changePassword.php">
                   <div class="form-group row mb-3">
                        
                    </div>
                     <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Username<span class="text-danger ml-2"></span></label>
                        <input required type="text" class="form-control" name="username"  id="exampleInputFirstName" >
                        </div>
                      
                    </div>
                     <div class="form-group row mb-3">
                       
                        <div class="col-xl-6">
                        <label class="form-control-label">Password<span class="text-danger ml-2"></span></label>
                        <input required type="password" class="form-control" name="password" id="exampleInputFirstName" >
                        </div>
                      
                    </div>
                     <div class="form-group row mb-3">
                       
                        <div class="col-xl-6">
                        <label class="form-control-label">New Password<span class="text-danger ml-2"></span></label>
                        <input required type="password" class="form-control" name="newpassword" value="" id="exampleInputFirstName" >
                        </div>
                      
                    </div>
                     <div class="form-group row mb-3">
                       
                        <div class="col-xl-6">
                        <label class="form-control-label">Confirm Password<span class="text-danger ml-2"></span></label>
                        <input required type="password" class="form-control" name="cpassword" value="" id="exampleInputFirstName" >
                        </div>
                      
                    </div>
                    
                    <button type="submit" name="change" class="btn btn-primary">Change</button>
                      
                  </form>
                 
                </div>
              </div>

           

        </div>
        <!---Container Fluid-->
      </div>
  <?php
}
  ?>
      


      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../scripts/themeChanger.js"></script>
    <script src="../scripts/logoutScript.js"></script>  

 
</body>

</html>
