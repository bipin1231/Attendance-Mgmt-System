<?php
include_once("../dbconnect.php");

session_start();

$reg=$fname=$lname='';
$success='';
$subjectName[]='';

echo  $_SESSION["reg"];
$reg=$_SESSION["reg"];


$query1="SELECT * FROM student where registration='$reg'";
$result1=mysqli_query($conn,$query1);

while($rows = mysqli_fetch_assoc($result1)){
  $fname=$rows['fname'];
  $lname=$rows['lname'];
}

$query2="SELECT distinct(bookName) FROM attendance where registrationNo='$reg'";
$subject=mysqli_query($conn,$query2);
$i=0;

while($rows = mysqli_fetch_assoc($subject)){
  $subjectName[$i]= $rows['bookName'];
  $i++;
}
foreach($subjectName as $s){
  echo $s;
}


$user_bookName='';

$attendanceDate="SELECT distinct(attendanceDate) FROM attendance where bookName='$user_bookName' ORDER by attendanceDate desc";
$DateResult=mysqli_query($conn,$attendanceDate);

if(isset($_GET['go'])){
                  
                    $user_bookName=$_GET['bookName'];
                    
                  }



   //date handling               
  $date='';
  $dateSubject[]='';

  if(isset($_GET['dateSearch'])){
    $date=$_GET['date'];
    echo $date;

   
$query2="SELECT distinct(bookName) FROM attendance where registrationNo='$reg' and attendanceDate='$date'";
$subject=mysqli_query($conn,$query2);
$i=0;

while($rows = mysqli_fetch_assoc($subject)){
  $dateSubject[$i]= $rows['bookName'];
  $i++;
}
foreach($subjectName as $s){
  echo $s;
}

  }

 //circular chart php handling 
 $attPerSub[]='';
 $query3="SELECT subject FROM attendancePercentage where registration='$reg'";
 $result3=mysqli_query($conn,$query3);
 $i=0;

 while($rows = mysqli_fetch_assoc($result3)){
   $attPerSub[$i]= $rows['subject'];
   $i++;
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
  <link href="css/ruang-admin.css" rel="stylesheet">

         
  <!-- flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


  <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/plugin.css">
        <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <!-- jQuery -->
        

        <link rel="stylesheet" href="css/style.css">
  <script defer src="app.js"></script>
        <style>
body{
  display: block;
}
          .check{
                padding: 200px;
              }
            .cir_row{
              
               margin-left: 10px; 
               margin-right: 10px; 
               margin-bottom: 10px;
            }
  
              
            </style>
 
    
</head>

<body id="">
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
            <h1 class="h3 mb-0 text-gray-800"><?php echo $fname." ".$lname; ?></h1>    
          </div>

          <!----------- circular chart ----------->
          <!-- <div class="container">   
          <div class="row">

          <?php 
          // foreach($attPerSub as $s){
          //   $query3="SELECT percentage FROM attendancePercentage where registration='$reg' and subject='$s'";
          //   $result3=mysqli_query($conn,$query3);
            
          //   $subPer=mysqli_fetch_column($result3);


          //   echo $subPer;
          
          ?>
            <div class="col-xs cir_row">       
            <div class="circular-progress">
        <div class="value-container">10%</div>
      </div>
      
            </div>
            

  <?php
       //   }
  ?>


                 
          </div>
          </div> -->
<!--           -->

            <div class="container">          
              <div class="col-lg-12">  
                <form action="" method="get">            
                <div class="row">          
                      
                       
                              
                        <div class="col-xl-3">
                     
                        <select name="bookName" class="form-control mb-3">
                        <option value="">--Select Subject--</option>
                         <?php 
                         $section_query="SELECT distinct(bookName) FROM attendance where registrationNo='$reg'";
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

                            <!--------        date search     ----------->
                            <div class="col-xl-3">
                              <form action="viewStudentAttendance" method="get">
                                <div>
                        <input type="date" name="date" class="form-control" id="date" placeholder="date">  
                        </div> 
                        <div>          
                      <input type="submit" name="dateSearch" class="btn btn-primary" value="search">        
                      </form>
                      </div>                  
                            </div>

   

                        </div>
                        </form>
                    </div>
              </div>
             

             <?php
             
             if(empty($user_bookName) && empty($date)){
              $i=0;
               foreach($subjectName as $s)
               {
                
               ?>
                
                <div class="table-responsive p-3">
                
                  <table class="table table-striped table-hover" id="myTable<?php echo $i ?>">
                    <thead class="thead-light">
                      <tr>
                     
                        <th>Attendance Date</th>
                       
                        <th>Attendance</th>
                      </tr>
                    </thead>
                
                    <tbody>
                 <?php
                      
                        $query="SELECT * FROM attendance where bookName='$s' and registrationNo='$reg'";
                        $result=mysqli_query($conn,$query);
                        while($rows=mysqli_fetch_assoc($result)){
                         if($rows['attendance']=='present'){
                         echo"
                           <tr>
                           <td>".$rows['attendanceDate']."</td>
                             
                             <td class='bg-success'>".$rows['attendance']."</td>";
                  
                       }
                       else{
                        echo"
                        <tr>
                        <td>".$rows['attendanceDate']."</td>
                          
                          <td class='bg-danger'>".$rows['attendance']."</td>";
                       }
                      }
                       $i++;
                       echo '<h1>'.$s.'<h1>';
                      }
             }
             ?>
                    </tbody>
                  </table>
               
             <?php
            if(!empty($user_bookName)){
              $query="SELECT * FROM attendance where bookName='$user_bookName' and registrationNo='$reg'";
              $result=mysqli_query($conn,$query);


              ?>

<div class="table-responsive p-3">
                
                  <table class="table align-items-center table-flush table-hover" id="myTable">
                    <thead class="thead-light">
                      <tr>
                     
                      
                       
                        <th>Attendance Date</th>
                       
                        <th>Attendance</th>
                      </tr>
                    </thead>
                
                    <tbody>
              <?php
              while($rows=mysqli_fetch_assoc($result)){
               
               echo"
                 <tr>
                 <td>".$rows['attendanceDate']."</td>
                   
                   <td>".$rows['attendance']."</td>";
        
             }
             echo $user_bookName;
             }


                if(!empty($date)){
                  
                 
                  foreach($dateSubject as $s){
                  $query="SELECT * FROM attendance where registrationNo='$reg' and attendanceDate='$date'";
                  $result=mysqli_query($conn,$query);
               
               


              ?>

<div class="table-responsive p-3">
      
                  <table class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                      <tr>
                     
                      
                       
                        <th>Attendance Date</th>
                       
                        <th>Attendance</th>
                      </tr>
                    </thead>
                
                    <tbody>
              <?php
               
            //  while($rows=mysqli_fetch_assoc($result)){
                $rows=mysqli_fetch_assoc($result);
               echo"
                 <tr>
                 <td>".$rows['attendanceDate']."</td>
                   
                   <td>".$rows['attendance']."</td>";
        
            // }
             echo $s;
             }

                 ?>

                    </tbody>
                    <?php
                    
                 }
                    ?>
                  </table>
            
                </div>
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
  

  

              

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="scripts/plugin.js"></script>


  


        <script>
$(document).ready(function(){
    $('#myTable0').dataTable();
});
$(document).ready(function(){
    $('#myTable1').dataTable();
});
</script>
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
