
<?php
include_once("../dbconnect.php");

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
session_start();
//Student information

$teacher_id=$_SESSION['username'];
$userDetails=0;
$attTakenSuccess='';
$attUpdateSuccess='';
$attTaken=0;
$user_semester=$user_section=$user_bookName='';

                  if(isset($_GET['go'])){
                    $user_section=$_GET['section'];
                    $user_semester=$_GET['semester'];
                    $user_bookName=$_GET['bookNames'];
                  
            
                 
                  if(empty($_GET['bookNames']) || empty($_GET['section']) || empty($_GET['semester'])){
                    $userDetails=1;
                  }
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
              
            
              <td><input name='check[]' type='checkbox' value=".$rows['registration']." class='form-control'></td>
              
              </tr>";
             echo "<input name='registrationNo[]' value=".$rows['registration']." type='hidden' class='form-control'>";
        }
    }
    else
    {
          echo   
          "<div class='alert alert-danger' role='alert'>
          No Record Found!
          </div>";
    }
}



if(isset($_POST['save'])){
  if(!isset($_POST['check'])){
    $userDetails=1;
  }
  else{
  $check=$_POST['check'];
  $registrationNo=$_POST['registrationNo'];
 foreach($check as $c){
 
 }
foreach($registrationNo as $r){
  $query="SELECT distinct(attendanceDate) FROM attendance WHERE registrationNO='$r' and bookName='$user_bookName'";
  $result=mysqli_query($conn,$query);
 
  /*
  $query="SELECT section,semester,roll_no FROM student WHERE registration='$r'";
  $result=mysqli_query($conn,$query);
  $rows = mysqli_fetch_assoc($result);
  echo $rows['section'];
  echo $rows['roll_no'];
*/

while($rows = mysqli_fetch_assoc($result)){
  if(date("Y-m-d")==$rows['attendanceDate']){
    $attTaken=1;
    break;
  }
}
if($attTaken!=1){
  $InsertQuery="INSERT into attendance(teacherID,registrationNO,section,semester,bookName) values('$teacher_id','$r','$user_section','$user_semester','$user_bookName')";
  mysqli_query($conn,$InsertQuery);
  $attTakenSuccess=1;
}
   

//insert into table attendancePercentage
//check if the subject is present in this table or not

$checkQuery="select * from attendancePercentage where registration='$r' and subject='$user_bookName'";
$result5=mysqli_query($conn,$checkQuery);
 //$rows5 = mysqli_fetch_assoc($result5);
 $num5=mysqli_num_rows($result5);
 if($num5<1){
  $queryPercent="insert into attendancePercentage(registration,subject,teacherID) values('$r','$user_bookName','$teacher_id')";
mysqli_query($conn,$queryPercent);
 }
 /*
 else{
  
 while($rows5 = mysqli_fetch_assoc($result5)){ 
 if($user_bookName!=$rows5['subject']){
$queryPercent="insert into attendancePercentage(registration,subject) values('$r','$user_bookName')";
mysqli_query($conn,$queryPercent);
 }
}
}
*/
}
foreach($check as $c){

   $query="UPDATE attendance set attendance='present' where registrationNO='$c' AND attendanceDate=current_date AND bookName='$user_bookName' ";
   mysqli_query($conn,$query);
}


//attendance percentage calculation

foreach($registrationNo as $r){
  $reg=$percentage='';

           $query1="SELECT count(attendanceDate) FROM attendance where registrationNo='$r' and bookName='$user_bookName'";
           $result1=mysqli_query($conn,$query1);
           $noOfAttendance=mysqli_fetch_column($result1);
           
           $query2="Select count(attendance) FROM attendance where registrationNo='$r' and attendance='present' and bookName='$user_bookName'";
           $result2=mysqli_query($conn,$query2);
           $noOfPresent=mysqli_fetch_column($result2);
          if($noOfAttendance>0){
         
            $percentage=($noOfPresent/$noOfAttendance)*100;
           
             $query3="update attendancePercentage
             set percentage='$percentage'
             where registration='$r' and subject='$user_bookName'";
             $result3=mysqli_query($conn,$query3);
         
        }
          
         }

         foreach($registrationNo as $r){
          //calculate total attendance percentage

          $totalAttendance=0;
          $query1="SELECT count(subject) as subject FROM attendancePercentage where registration='$r'";
          $result1=mysqli_query($conn,$query1);
          $noOfBooks=mysqli_fetch_column($result1);
         
          
          $query2="SELECT percentage FROM attendancePercentage where registration='$r'";
          $result2=mysqli_query($conn,$query2);
        
          while($rows2 = mysqli_fetch_assoc($result2)){
            
            $totalAttendance+=$rows2['percentage'];
          }
         

          $totalAttendancePercent=($totalAttendance/($noOfBooks*100))*100;
          

          $query3="update student set attendancePercentage='$totalAttendancePercent' where registration='$r'";
          $result3=mysqli_query($conn,$query3);

         }
     }  


    }
    
  
?>

<!--------------------------- php mailer ----------------------------------------->
<?php

if($attTaken==1){
  $i=0;
  $date=date("Y-m-d");
  $absentStudent[]='';
  $studentEmail[]='';
  $query10="select * from attendance where teacherID='$teacher_id' and bookName='$user_bookName' and attendance='absent' and attendanceDate='$date'";
  $result10=mysqli_query($conn,$query10);
  while($rows=mysqli_fetch_assoc($result10)){
    $absentStudent[$i]=$rows['registrationNO'];
    
    $i++;
  }

  foreach($absentStudent as $a){
  $query10="select * from student where registration='$a'";
  $result10=mysqli_query($conn,$query10);
  while($rows=mysqli_fetch_assoc($result10)){
   
    $fname=$rows['fname'];
    $lname=$rows['lname'];
    

 

    $mail = new PHPMailer(true);
  
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='bipinadhikari739@gmail.com';
    $mail->Password='icvk cbbq snqr dcph';
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
      $mail->Port       = 465;   
  
      $mail->setFrom('bipinadhikari739@gmail.com');
      $mail->addAddress($rows['email']);
  
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Absent Notice';
      $mail->Body    = ' <b> MR.'.$fname.' '.$lname.' is absent in subject'.$user_bookName.'</b>';
     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     $mail->send();
    
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

  <style>
    .check{
      padding: 200px;
    }
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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Students</h1>
            <ol class="breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students Information</li> -->
            </ol>
          </div>
<!-------------------------------- enter all data message  -------------------------------------------------->
        <?php
        if($userDetails==1){

          ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>please enter all information</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
        }
        ?>

        <!------------------------------------------------ attendance taken success message ----------------------------- -->
        <?php
        if(!empty($attTakenSuccess)){

          ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Attendance Taken Successfully</strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        }
        ?>
     

            <div class="container">          
              <div class="col-lg-12">  
                          
                <div class="row">          
                        <div class="col-xl-3">
                        <form action="" method="get">                     
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
                     
                        <select name="bookNames" class="form-control mb-3">
                        <option value="">--Select Subject--</option>
                         <?php 
                         $section_query="SELECT bookName FROM teacherSubject where teacher_id='$teacher_id'";
                         $section_result=mysqli_query($conn,$section_query);
                  
                          while ($row = mysqli_fetch_assoc($section_result)){
                          echo'<option value='.$row['bookName'].'>'.$row['bookName'].
                          '</option>';
                              }
                              
                                ?> 
                                
                            </select> 
                    
                        </div>
                   
                            <div class="col-xl-3">
                    <input type="submit" name="go" value="GO" class="btn btn-primary">
                    </form>
                            </div>
                           

                        </div>
                        
                    </div>
              </div>
             

                <?php echo "<h3>".$user_bookName."</h3>" ?>
                <div class="table-responsive p-3">
                <form action="" method="post">
                  <table class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                      <tr>
                      <th>Registration No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll No</th>
                      
                        <th>Semester</th>
                        <th>Section</th>
                       
                        <th>Check</th>
                      </tr>
                    </thead>
                
                    <tbody>
                    
                  <?php

                  
                 
                    if(empty($user_semester) && empty($user_section)){
                      $query="SELECT * FROM student";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                     tableData($num,$result);
                        }


                    else if(isset($user_semester) && empty($user_section)){
                        $query="SELECT * FROM student where semester='$user_semester'";
                        $result=mysqli_query($conn,$query);
                        $num=mysqli_num_rows($result);
                       tableData($num,$result);
                    }
                    else if(isset($user_section) && empty($user_semester)){
                      $query="SELECT * FROM student where section='$user_section'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                    else{
                      $query="SELECT * FROM student where semester='$user_semester' AND section='$user_section'";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                      tableData($num,$result);
                    }
                      
                      ?>
                      
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col"></div>
                    
                  <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
                  </div>
                    </form>
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
</body>
</html>