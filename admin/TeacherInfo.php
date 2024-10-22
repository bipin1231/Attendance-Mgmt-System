<?php
include_once("../dbconnect.php");
session_start();


//delete php

if(isset($_POST['delete_button'])){

  $teacher_id=$_POST['delete'];

  $query="update teacher set active=0 WHERE teacher_id='$teacher_id'";
  if(mysqli_query($conn,$query)){
    echo "Record deleted successfully";
  }
  else {
    echo "Error deleting record: " . mysqli_error($conn);
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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Teachers</h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Teachers Information</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
        
               
                
              </div>

              <!-- Input Group -->
                 <div class="row ml-3">
              <div class="col-lg-12">
              <div class="card mb-4">
              
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="myTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Teacher ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                       
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php

                      $query="SELECT * FROM teacher where active=1";
                      $result=mysqli_query($conn,$query);
                      /*
                      if($num > 0)
                      { */
                        while ($rows = mysqli_fetch_assoc($result))
                          {
                            echo"
                              <tr>
                              <td>".$rows['teacher_id']."</td>
                                <td>".$rows['fname']."</td>
                                <td>".$rows['lname']."</td>
                               
                                
                                <td><a href='updateTeacher.php?id=$rows[teacher_id] & fname=$rows[fname] & lname=$rows[lname]'><button class='btn  none btn-success btn-sm rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button></a>
                                </td>
                                <td>
                                <form method='post' onsubmit='return del();'>
                                <input type='hidden' name='delete' value=".$rows['teacher_id'].">
                                <button name='delete_button'  class='btn none btn-danger btn-sm rounded-0' type='submit' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i></button>

                                </form>
                                </td>
                                
                              </tr>";
                          }
                      // }
                      // else
                      // {
                      //      echo   
                      //      "<div class='alert alert-danger' role='alert'>
                      //       No Record Found!
                      //       </div>";
                      // }
                      // */
                      ?>
                    </tbody>
                  </table>
                </div>
         <?php         
          if(isset($_SESSION['teacher_update'])){
          
          if (basename($_SERVER['PHP_SELF']) != $_SESSION['teacher_update']) {
            session_destroy();
             }
        
        echo " 
        <div class='alert alert-success'>
         <strong>Success!</strong> Teacher information updated.
         </div>";
        }
        ?>
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

  <!-- Page level custom scripts -->
  <script>

function del(){
  
   return confirm("Data will be deleted");

}

</script>
 
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</body>

</html>