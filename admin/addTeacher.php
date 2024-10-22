<?php

include_once("../dbconnect.php");
$fname=$lname=$teacher_id='';
$teacher_id_repeated=$invalid_id='';
//$reg_no_repeated=$roll_no_repeated=$invalid_roll_no='';
$success='';
if($_POST){
$fname=trim($_POST['fname']);
$lname=trim($_POST['lname']);
$teacher_id=trim($_POST['teacher_id']);


$check_id="SELECT teacher_id FROM teacher WHERE teacher_id='$teacher_id'";

if(mysqli_num_rows(mysqli_query($conn,$check_id))>0){
  $teacher_id_repeated='This teacher id is already exits';
  echo $teacher_id_repeated;
}

if(is_numeric($teacher_id)==0 || $teacher_id<1){
  $invalid_id='Invalid ID';
  echo $invalid_id;
}

if(empty($teacher_id_repeated) && empty($invalid_id)){
  $query="INSERT INTO teacher(teacher_id,fname,lname) VALUES(?,?,?)";
  $stmt=mysqli_prepare($conn,$query);
  mysqli_stmt_bind_param($stmt,"sss",$teacher_id,$fname,$lname);
  if(mysqli_stmt_execute($stmt)){
    $success='teacher added succesfully';
    echo $success;
    // header("location:addstudents.php");
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
            <h1 class="h3 mb-0" style=" color: var(--textColor);">Teachers</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 
                    <?php //echo $statusMsg; ?>
                </div>
             
                <div class="card-body popupAddTeacher none">
                  <form method="post" action="">
                   <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Firstname<span class="text-danger ml-2"></span></label>
                        <input type="text" class="form-control" required name="fname" value="" id="exampleInputFirstName">
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Lastname<span class="text-danger ml-2"></span></label>
                      <input type="text" class="form-control" required name="lname" value="" id="exampleInputFirstName" >
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Teacher ID<span class="text-danger ml-2"></span></label>
                        <input type="" class="form-control" required name="teacher_id" value="" id="exampleInputFirstName" >
                        </div>
                    </div>
                     <!-- <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
                        <input type="email" class="form-control" required name="emailAddress" value="<?php //echo $row['emailAddress'];?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Phone No<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="phoneNo" value="<?php //echo $row['phoneNo'];?>" id="exampleInputFirstName" >
                        </div>
                    </div> -->
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                   
                    <button type="submit" name="save" class="btn btn-primary">add</button>
                  
                  </form>
                </div>
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