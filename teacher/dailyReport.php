
<?php
include_once("../dbconnect.php");
session_start();
//Student information

$teacher_id=$_SESSION['username'];

$user_semester=$user_section=$user_bookName='';


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

   
        }
    }
}

$date='';
  $dateSubject[]='';

  if(isset($_GET['dateSearch'])){
    $date=$_GET['date'];
    echo $date;
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
    

  <!-- flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


  <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/plugin.css">
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <!-- jQuery -->

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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Daily Attendance Report</h1>
            <ol class="breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students Information</li> -->
            </ol>
          </div>



           <!--------        date search     ----------->
           <form action="" method="get">
            <div class="row">
              <!-- <div class="col-sm-4"> -->
           <div class="input-group mb-3"  style="display: flex; gap: 30px; padding-left: 1.5rem; width: 40%;">
                           
                               
                        <input type="date" name="date" class="form-control" style="color: var(--textColor); border-radius: 4px;" id="date" placeholder="search with date" aria-describedby="basic-addon2">  
                         
                        <button class="btn btn-outline-secondary" type="submit" name="dateSearch">Search</button> 
                        <div>          
                      <!-- <input type="submit" name="dateSearch" class="btn btn-primary" value="search"> -->
                        </div>       
                      
                      </div> 
            <!-- </div>   -->
            </div>
                      </form>
                      
                      

                    


            
         
             

             <?php
             /*
              if(empty($user_bookName)){
                echo "please enter subject";
              }
              else{*/
              //       while($dateRows=mysqli_fetch_assoc($dateResult)){
              //         echo $dateRows['attendanceDate'];
             
              //  $book[]='';
              //  $i=0;
              //  $query5="select bookName from teacherSubject where teacher_id='$teacher_id'";
              //  $result5=mysqli_query($conn,$query5);
              //  while($rows=mysqli_fetch_assoc($result5)){
              //  $book[$i]=$rows['bookName'];
              //  echo $book[$i];
              //  $i++;
        
              // }
              // foreach($book as $b){

                if(empty($date)){
                $attendanceDate="SELECT distinct(attendanceDate),bookName FROM attendance ORDER by attendanceDate desc";
                $dateResult=mysqli_query($conn,$attendanceDate);
                while($dateRows=mysqli_fetch_assoc($dateResult)){
             
                     $dateBook=$dateRows['bookName'];
          
          
         
               ?>
               <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="table-responsive p-3">
                <form action="" method="post">
                  <table id="myTable" class="table align-items-center table-flush table-hover">
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

                    
                    
                  
                  
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where bookName='$dateBook' and attendanceDate='$dateRows[attendanceDate]' and teacherID='$teacher_id'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                        

                    echo "<h3>".$dateRows['attendanceDate']."</h3>";
                    echo "<h4>".$dateBook."</h4>";
                     
                      ?>
                      
                    </tbody>
                  </table>
                
                 
                    </form>
                </div>
              </div>
               </div>
               <?php
                     }}
          ?>

          <?php
          if(isset($date)){
           
              $attendanceDate="SELECT distinct(bookName) FROM attendance where attendanceDate='$date' and teacherID='$teacher_id' ";
              $dateResult=mysqli_query($conn,$attendanceDate);
              while($dateRows=mysqli_fetch_assoc($dateResult)){
           
                   $dateBook=$dateRows['bookName'];
        
        
       
        
          
          ?>
           <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="table-responsive p-3">
                <form action="" method="post">
                  <table id="myTable" class="table align-items-center table-flush table-hover">
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

                    
                    
                  
                  
                      $query="SELECT * FROM student inner join attendance on student.registration=attendance.registrationNO where bookName='$dateBook' and attendanceDate='$date' and teacherID='$teacher_id'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                        

                    echo "<h3>".$date."</h3>";
                    echo "<h4>".$dateBook."</h4>";
                     
                      ?>
                      
                    </tbody>
                  </table>
                
                 
                    </form>
                </div>
              </div>
               </div>
            <?php
              }}
            ?>

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
  
</body>

</html>
 <!-- flatpickr -->
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
config={
dateFormat: "Y-m-d",
}

flatpickr("#date", {});
</script>