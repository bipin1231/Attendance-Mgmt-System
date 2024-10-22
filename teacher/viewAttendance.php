
<?php
include_once("../dbconnect.php");
session_start();
//Student information

$teacher_id=$_SESSION['username'];

$user_semester=$user_section=$user_bookName='';

$attendanceDate="SELECT distinct(attendanceDate) FROM attendance where bookName='$user_bookName' ORDER by attendanceDate desc";
$dateResult=mysqli_query($conn,$attendanceDate);




                  if(isset($_GET['go'])){
                    $user_section=$_GET['section'];
                    $user_semester=$_GET['semester'];
                    $user_bookName=$_GET['bookName'];
                    
                  }

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

              echo "</tr>";

             
   
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style=" color: var(--textColor);">Students</h1>
            <ol class="breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students Information</li> -->
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
                     
                        <select name="bookName" class="form-control mb-3">
                        <option value="">--Select Subject--</option>
                         <?php 
                         $section_query="SELECT bookName FROM teacherSubject where teacher_id=$teacher_id";
                         $section_result=mysqli_query($conn,$section_query);
                  
                          while ($row = mysqli_fetch_assoc($section_result)){
                          echo'<option value='.$row['bookName'].'>'.$row['bookName'].
                          '</option>';
                              }
                                ?> 
                            </select> 
                    
                        </div>
                   
                            <div class="col-xl-3">
                    <button type="submit" name="go" class="btn btn-primary">GO</button>
                            </div>
                            <div class="col-xl-3">


                         
                            </div>

                        </div>
                        </form>
                    </div>
              </div>
             

             <?php
             /*
              if(empty($user_bookName)){
                echo "please enter subject";
              }
              else{
                    while($dateRows=mysqli_fetch_assoc($dateResult)){
                      
               */ 
              // $book[]='';
              // $i=0;
              // $query5="select bookName from teacherSubject where teacher_id='$teacher_id'";
              // $result5=mysqli_query($conn,$query5);
              // while($rows=mysqli_fetch_assoc($result5)){
              // $book[$i]=$rows['bookName'];
              // echo $book[$i];
              // $i++;
              
              // }
              // foreach($book as $b){
               ?>
               
                <div class="table-responsive p-3 table-striped">
                <form action="" method="post">
                  <table id="myTable" class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                      <tr>
                      <th>Registration No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll No</th>
                      
                        <th>Semester</th>
                        <th>Section</th>
                        <th>Attendance Date</th>
                        <th>Subject</th>
                        <th>Attendance</th>
                      </tr>
                    </thead>
                
                    <tbody>
                    
                  <?php

                    
                    
                  
                    if(empty($user_semester) && empty($user_section)){
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                        }


                    else if(isset($user_semester) && empty($user_section)){
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where semester='$user_semester'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                    else if(isset($user_section) && empty($user_semester)){
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where section='$user_section'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                    else{
                      
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where bookName='$user_bookName' order by attendanceDate";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                      
                    }
                 //   echo $dateRows['attendanceDate'];
                  //  echo $user_bookName;
                     
                     
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