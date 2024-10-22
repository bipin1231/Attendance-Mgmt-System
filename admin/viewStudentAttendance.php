<?php
include_once("../dbconnect.php");
session_start();
$reg_no=$_SESSION['reg'];
$query="SELECT * FROM attendancePercentage where registration='$reg_no'";
  $result=mysqli_query($conn,$query); 
  
  $query1="SELECT fname,lname FROM student where registration='$reg_no'";
 $result1=mysqli_query($conn,$query1);

$row=mysqli_fetch_assoc($result1);
$fname=$row['fname'];
$lname=$row['lname'];
  
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
  <link href="css/ruang-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/theme.css">
  <link rel="stylesheet" href="../css/loginStyle.css">

  
<style media="screen">
  @import url(http://fonts.googleapis.com/css?family=Roboto:400,700,300);

.all{
  display: flex;
}
.circle-wrap {
  display: grid;
  grid-template-columns: repeat(1, 160px);
  grid-gap: 80px;
  margin-top: 100px;
  margin-left: 50px;
  width: 150px;
  height: 150px;
  background: #d9d7da;
  border-radius: 50%;
}

.circle-wrap .circle .mask,
.circle-wrap .circle .fill-1,
.circle-wrap .circle .fill-2,
.circle-wrap .circle .fill-3 {
  width: 150px;
  height: 150px;
  position: absolute;
  border-radius: 50%;
}

.circle-wrap .circle .mask {
  clip: rect(0px, 150px, 150px, 75px);
}

.circle-wrap .inside-circle {
  width: 124px;
  height: 124px;
  border-radius: 50%;
  background: #212020;
  line-height: 120px;
  text-align: center;
  margin-top: 13px;
  margin-left: 13px;
  color: white;
  position: absolute;
  z-index: 100;
  font-weight: 700;
  font-size: 2em;
}

/* color animation */
<?php  
          $i=1;
           $result=mysqli_query($conn,$query);
          while($row=mysqli_fetch_assoc($result)){ ?>
<?php if($row['percentage']>=70){ ?>
<?php echo ".mask .fill-".$i." {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: green;
}"; ?>

<?php echo ".mask.full-".$i." ,
.circle .fill-".$i."{
  animation: fill-".$i." ease-in-out 3s;
  transform: rotate(".$row['percentage']*1.8."deg); 
}";
?>
<?php 
echo "@keyframes fill-".$i." {
  0% {
    transform: rotate(0deg);
  }
  100% {
   transform: rotate(".$row['percentage']*1.8."deg);
  }
}
"; 
?>
<?php 
}else if($row['percentage']<70 && $row['percentage']>=30){?>
<?php echo ".mask .fill-".$i." {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #ff8100;
}"; ?>

<?php echo ".mask.full-".$i." ,
.circle .fill-".$i."{
  animation: fill-".$i." ease-in-out 3s;
  transform: rotate(".$row['percentage']*1.8."deg); 
}";
?>
<?php 
echo "@keyframes fill-".$i." {
  0% {
    transform: rotate(0deg);
  }
  100% {
   transform: rotate(".$row['percentage']*1.8."deg);
  }
}
"; 
?>
<?php
}else{
?>
<?php echo ".mask .fill-".$i." {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: red;
}"; ?>

<?php echo ".mask.full-".$i." ,
.circle .fill-".$i."{
  animation: fill-".$i." ease-in-out 3s;
  transform: rotate(".$row['percentage']*1.8."deg); 
}";
?>
<?php 
echo "@keyframes fill-".$i." {
  0% {
    transform: rotate(0deg);
  }
  100% {
   transform: rotate(".$row['percentage']*1.8."deg);
  }
}
"; 
?>
<?php }?>
<?php 
$i++;
} ?>
/* 2nd bar */
/*
.mask .fill-2 {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: yellow;
}

.mask.full-2,
.circle .fill-2 {
  animation: fill-2 ease-in-out 3s;
  transform: rotate(117deg);
}

@keyframes fill-2{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(117deg);
  }
}
*/
/* 3rd progress bar */
/*
.mask .fill-3 {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #23b9ea;
}

.mask.full-3,
.circle .fill-3 {
  animation: fill-3 ease-in-out 3s;
  transform: rotate(135deg);
}

@keyframes fill-3{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(135deg);
  }
}
*/

</style>


</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
           <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style=" color: var(--textColor);"><?php echo $fname." ".$lname; ?></h1>
            <!-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol> -->
          </div>

          <div class="row mb-3">
          <!-- New User Card Example -->
          <?php  
          $i=1;
           $result=mysqli_query($conn,$query);
          while($row=mysqli_fetch_assoc($result)){ ?>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card">
                <div class="card-body"><h4>
                 <?php  echo $row['subject']; ?></h4>
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                
                      <div class="circle-wrap">
                       
    <div class="circle">
      <div class="mask full-<?php echo $i; ?>">
        <div class="fill-<?php echo $i; ?>"></div>
      </div>
      <div class="mask half">
        <div class="fill-<?php echo $i; ?>"></div>
      </div>
      <div class="inside-circle"> <?php echo $row['percentage']."%"; ?> </div>
      
    </div>


   
  </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>


            <?php
          $i++;
          } ?>
            <!-- Earnings (Monthly) Card Example -->
           
           
          
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                   
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-code-branch fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            
            <!-- Pending Requests Card Example -->
          
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student Attendance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                    
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          
          <!--Row-->

          <!-- <div class="row">
            <div class="col-lg-12 text-center">
           
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
  <script src="../scripts/themeChanger.js"></script> 
    <script src="../scripts/logoutScript.js"></script>
</body>

</html>