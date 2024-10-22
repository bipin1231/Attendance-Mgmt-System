<?php
include_once("../dbconnect.php");
$fname=$lname=$reg_no=$roll_no=$semester_no=$section='';
$reg_no_repeated=$roll_no_repeated=$invalid_roll_no='';
$success='';
$reg_no_get=$_GET['id'];
//to display the data at input
$display="SELECT * FROM student WHERE registration='$reg_no_get'";
//$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc(mysqli_query($conn,$display));
$fname=$row['fname'];
$lname=$row['lname'];
$roll_no=$row['roll_no'];
$semester_no=$row['semester'];
$section=$row['section'];

//update the data

if(isset($_POST['update'])){
$fname=trim($_POST['fname']);
$lname=trim($_POST['lname']);
$reg_no=trim($_POST['registration']);
$roll_no=$_POST['roll_no'];
$semester_no=$_POST['semester'];
$section=$_POST['section'];

$check_reg="SELECT registration FROM student WHERE registration='$reg_no'";
$check_roll="SELECT roll_no FROM student WHERE roll_no='$roll_no' AND semester='$semester_no' AND section='$section'";

if(mysqli_num_rows(mysqli_query($conn,$check_reg))>1){
  $reg_no_repeated='This registration number is already taken';
  echo $reg_no_repeated;
}

if(mysqli_num_rows(mysqli_query($conn,$check_roll))>1){
  $roll_no_repeated="roll number is repeated";
  echo $roll_no_repeated;
}
if(is_numeric($roll_no)==0 || $roll_no<1){
  $invalid_roll_no='Invalid Roll Number';
  echo $invalid_roll_no;
}

if(empty($reg_no_repeated) && empty($roll_no_repeated) && empty($invalid_roll_no)){
  $query="UPDATE student SET registration=?,fname=?,lname=?,roll_no=?,semester=?,section=? WHERE registration='$reg_no_get'";
  $stmt=mysqli_prepare($conn,$query);
  mysqli_stmt_bind_param($stmt,"ssssss",$reg_no,$fname,$lname,$roll_no,$semester_no,$section);
  if(mysqli_stmt_execute($stmt)){
    session_start();
    $_SESSION['student_update']='';
    
   header("location:StudentsInfo.php");
  }
  else{
    echo "error".mysqli_error($conn);
  }
  mysqli_stmt_close($stmt);
}
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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Update Student</h1>
            <ol class="breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"></li> -->
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <?php //echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                   <div class="form-group row mb-3" action="addStudent.php" method="post">
                        <div class="col-xl-6">
                        <label class="form-control-label">Registration Number</label>
                        <input type="text" class="form-control" name="registration" value="<?php echo $reg_no_get?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Roll Number</label>
                         <input type="text" class="form-control" required name="roll_no" value="<?php echo $roll_no?>" id="exampleInputFirstName" >
                          </div>
                    </div>
                     <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Firstname</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo $fname?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Lastname</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $lname?>" id="exampleInputFirstName" >
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Select Semester</label>
                        <select required name="semester" class="form-control mb-3">
                        <option value="<?php echo $semester_no?>"><?php echo $semester_no?></option>
                         <?php 
                         $semquery="SELECT * FROM semester";
                         $semresult=mysqli_query($conn,$semquery);
                   
                          while ($row = mysqli_fetch_assoc($semresult)){
                          echo'<option value='.$row['semester'].'>'.$row['semester'].'</option>';
                              }
                           ?> 
                            </select> 
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Select Section</label>
                        <select required name="section" class="form-control mb-3">
                        <option value="<?php echo $section?>"><?php echo $section?></option>
                         <?php 
                         $section_query="SELECT * FROM section";
                         $section_result=mysqli_query($conn,$section_query);
                  
                          while ($row = mysqli_fetch_assoc($section_result)){
                          echo'<option value='.$row['section_name'].'>'.$row['section_name'].
                          '</option>';
                              }
                                ?> 
                            </select> 
                    
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    
                  </form>
                </div>
              </div>

     

        </div>
        <!---Container Fluid-->
      </div>
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