
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
      <?php include "Includes/settingSidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/settingTopbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color: var(--textColor);">Students</h1>
          </div>




             


                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="myTable">
                    <thead class="thead-light">
                      <tr>
                      <th>Registration No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll No</th>
                        
                      </tr>
                    </thead>
                
                    <tbody>

                  <?php

                
                 
                      $query="SELECT * FROM student where active=0";
                      $result=mysqli_query($conn,$query);
                      $num=mysqli_num_rows($result);
                     tableData($num,$result);
                      
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