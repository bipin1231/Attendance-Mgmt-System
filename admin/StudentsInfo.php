
<?php
include_once("../dbconnect.php");
session_start();
//Student information

function tableData($num,$result){
if($num > 0)       
 { 
      while($rows = mysqli_fetch_assoc($result))
        {
          
          echo"
            <tr>
            <td>".$rows['registration']."</td>
              <td>".$rows['fname']."</td>
              <td>".$rows['lname']."</td>
              <td>".$rows['roll_no']."</td>
              <td>".$rows['semester']."</td>
              <td>".$rows['section']."</td>
              <td><a href='regSession.php?id=$rows[registration]'>$rows[attendancePercentage]</button></a>
                                </td>
              
              <td><a href='updateStudents.php?id=$rows[registration] & fname=$rows[fname] & lname=$rows[lname]'><button class='btn  none btn-success btn-sm rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button></a>
                                </td>
              <td>
              <form method='post' onsubmit='return del();'>
                                <input type='hidden' name='delete' value=".$rows['registration'].">
                                <button name='delete_button'  class='btn btn-danger none btn-sm rounded-0' type='submit' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i></button>

                   </form>
                   </td>
             
            </tr>";
        }
    }
   
}

//Delete

if(isset($_POST['delete_button'])){

  $registration=$_POST['delete'];


  $query="update student set active=0 WHERE registration='$registration'";
  if(mysqli_query($conn,$query)){
   
  }
  else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}

?>

<script>

    function del(){
      
       return confirm("Data will be deleted");

    }
    
  </script>


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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Students</h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students Information</li>
            </ol>
          </div>




            <div class="container">          
              <div class="col-lg-12">  
                <form action="" method="get">            
                <div class="row">          
                        <div class="col-xl-3">                   
                        <select name="semester" class="form-control mb-3">
                        <option value="">--Select Semester--</option>
                         <?php 
                         $semquery="SELECT * FROM semester";
                         $semresult=mysqli_query($conn,$semquery);
                   
                          while ($row = mysqli_fetch_assoc($semresult)){
                          echo'<option value='.$row['semester'].'>'.$row['semester'].'</option>';
                              }
                           ?> 
                            </select> 
                        </div>
                        <div class="col-xl-3">
                     
                        <select name="section" class="form-control mb-3">
                        <option value="">--Select Section--</option>
                         <?php 
                         $section_query="SELECT * FROM section";
                         $section_result=mysqli_query($conn,$section_query);
                  
                          while ($row = mysqli_fetch_assoc($section_result)){
                          echo'<option value='.$row['section_name'].'>'.$row['section_name'].
                          '</option>';
                              }
                                ?> 
                            </select> 
                    
                        </div>
                   
                            <div class="col-xl-3">
                    <button type="submit" name="go" class="btn btn-primary">GO</button>
                            </div>
                            <div class="col-xl-3">

                            <!-- //session -->

                            <?php         
                                    if(isset($_SESSION['student_update'])){
                                    
                                    if (basename($_SERVER['PHP_SELF']) != $_SESSION['student_update']) {
                                      session_destroy();
                                      }
                                  
                                  echo " 
                                  <div class='alert alert-success'>
                                  <strong>Success!</strong> student information updated.
                                  </div>";
                                  }
                        ?>
                            </div>

                        </div>
                        </form>
                    </div>
              </div>
             


                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="myTable">
                    <thead class="thead-light">
                      <tr>
                      <th>Registration No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll No</th>
                        <th>Semester</th>
                        <th>Section</th>
                        <th>Attendance</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                
                    <tbody>

                  <?php

                  $user_semester=$user_section='';
                  if(isset($_GET['go'])){
                    $user_section=$_GET['section'];
                    $user_semester=$_GET['semester'];
                  
                  }
                 
                    if(empty($user_semester) && empty($user_section)){
                      $query="SELECT * FROM student where active=1";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                     tableData($num,$result);
                        }


                    else if(isset($user_semester) && empty($user_section)){
                        $query="SELECT * FROM student where semester='$user_semester' and active=1";
                        $result=mysqli_query($conn,$query);
                        $num=mysqli_num_rows($result);
                       tableData($num,$result);
                    }
                    else if(isset($user_section) && empty($user_semester)){
                      $query="SELECT * FROM student where section='$user_section' and active=1";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                    else{
                      $query="SELECT * FROM student where semester='$user_semester' AND section='$user_section' and active=1";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                  
                      ?>
                    </tbody>
                  </table>
                </div>
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

  
  <script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</body>

</html>