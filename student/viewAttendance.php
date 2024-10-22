
<?php
include_once("../dbconnect.php");
session_start();
//Student information

$reg_no=$_SESSION['username'];

$fname=$lname='';
$user_bookName;
 $query="SELECT * FROM student where registration='$reg_no'";
 $result=mysqli_query($conn,$query);

$row=mysqli_fetch_assoc($result);
$fname=$row['fname'];
$lname=$row['lname'];
$roll=$row['roll_no'];
$section=$row['section'];

if(isset($_GET['go'])){
   
    $user_bookName=$_GET['bookName'];
    
  }



function tableData($num,$result){
if($num > 0)       
 { 
      while($rows = mysqli_fetch_assoc($result))
        {
          
          echo"
            <tr>
          
              
              
              <td>".$rows['attendanceDate']."</td>
              <td>".$rows['bookName']."</td>";
              if($rows['attendance']=='present'){
                echo"
                 
                    
                    <td class='bg-success'>".$rows['attendance']."</td>";
         
              }
              else{
               echo"
              
                 
                 <td class='bg-danger'>".$rows['attendance']."</td>";
              }
             }
   
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

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  
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
          <div class=" align-items-center justify-content-between mb-4">
            <h1 class="h3 my-2" style=" color: var(--textColor);"><?php echo $fname." ".$lname; ?></h1>
            <h3 class="h5 my-2" style=" color: var(--textColor);">Roll No.:<span class="ml-2"><?php echo $roll; ?></span></h3>
            <h3 class="h5 my-2" style=" color: var(--textColor);">Section:<span class="ml-2"><?php echo $section; ?></span></h3>
            <h3 class="h5 my-2" style=" color: var(--textColor);">Registration No.:<span class="ml-2"><?php echo $reg_no; ?></span></h3>
          </div>




            <div class="container">          
            <div class="col-lg-12"> 
             
                <form action="" method="get">
                <div class="row">
            <div class="col-xl-3">
                     
                     <select name="bookName" class="form-control mb-3">
                     <option value="">Select Subject</option>
                      <?php 
                      $section_query="SELECT distinct(bookName) FROM attendance where registrationNo='$reg_no'";
                      $section_result=mysqli_query($conn,$section_query);
               
                       while ($row = mysqli_fetch_assoc($section_result)){
                       echo'<option value='.$row['bookName'].'>'.$row['bookName'].
                       '</option>';
                           }
                             ?> 
                         </select> 
                 
                     </div>
                     <div class="col-xl-3">
                    <button type="submit" name="go" class="btn btn-primary">Search</button>
                            </div>
                </form>
            </div>
            </div>
         
           
               
                <div class="table-responsive p-3 table-striped">
                <form action="" method="post">
                  <table id="myTable" class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                      <tr>
                     
                      
                       
                        <th>Attendance Date</th>
                        <th>Subject</th>
                        <th>Attendance</th>
                      </tr>
                    </thead>
                
                    <tbody>
                    
                  <?php

                    
                    
                  
                    if(empty($user_bookName)){
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where student.registration='$reg_no'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }

                    if(!empty($user_bookName)){
                        $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where student.registration='$reg_no' and bookName='$user_bookName'";
                        $result=mysqli_query($conn,$query);
                        $num=mysqli_num_rows($result);
                        tableData($num,$result);
                      }
                  
                     
                     
                      ?>
                      
                    </tbody>
                  </table>
                 
                    </form>
                </div>
              </div>
           
            </div>
          </div>
        

        </div>
        <!---Container Fluid-->
      </div>

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
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</body>

</html>