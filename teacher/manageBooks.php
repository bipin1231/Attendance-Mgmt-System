<?php
include_once("../dbconnect.php");
session_start();

$teacher_id=$_SESSION['username'];

//delete php

if(isset($_POST['delete_button'])){

  $subject=$_POST['delete'];

  $query="delete from teacherSubject where bookName='$subject'";
  mysqli_query($conn,$query);
}

// search
$search='';
if(isset($_GET['add'])){
  $search=trim($_GET['search']);

   $query="INsERT into teacherSubject(teacher_id,bookName) values('$teacher_id','$search')";
   $result=mysqli_query($conn,$query);  


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
  <link rel="stylesheet" href="../css/loginStyle.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
  <link rel="stylesheet" href="../css/theme.css">

  <link rel="stylesheet" href="../css/loginStyle.css">
  
   

<style>
  select option {
  margin: 40px;
  background: black;
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
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
            <h1 class="h3 mb-0" style="color: var(--textColor);">Books</h1>
          </div>

      
        

<p>
  
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Add Books
  </button>
</p>
<div class="collapse" id="collapseExample">
 
          
                    <form action="" method="get">             
                        <select name="search" class="form-control" id="search" style="color: black; width:300px;">
                        <option value="">Search Books</option>
                         <?php 
                         $semquery="SELECT distinct(bookName) FROM book";
                         $semresult=mysqli_query($conn,$semquery);
                   
                          while ($row = mysqli_fetch_assoc($semresult)){
                          echo'<option style="background:red;" value='.$row['bookName'].'>'.$row['bookName'].'</option>';
                        
                          }
                          
                           ?> 
                            </select> 
                            <button type="submit" name="add" class="btn btn-primary">ADD</button>
                    </form>
                    
           
              <script type="text/Javascript">
                      $("#search").select2({
                        placeholder:"Search Record",
                        allowClear:true,
                       
                        
                      });
                     
                    </script>


            
  </div>










          </div>

         

        
          <div class="row">
            <div class="col-lg-12">
        
               
              
              </div>




              <!-- Input Group -->
                 <div class="row" style="margin-left: 100px;">
                 <!-- <div class="row"> -->
              <div class="col-lg-12">
              <div class="card mb-4">
             
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                      <tr>
                        
                        <th>Subject</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php

                      $query="SELECT * FROM teacherSubject where teacher_id='$teacher_id'";
                      $result=mysqli_query($conn,$query);
                      /*
                      if($num > 0)
                      { */
                        while ($rows = mysqli_fetch_assoc($result))
                          {
                            echo"
                              <tr>
                             
                               
                                <td>".$rows['bookName']."</td>
                                
                               <td>
                                <form method='post' onsubmit='return del();'>
                                <input type='hidden' name='delete' value=".$rows['bookName'].">
                                <button name='delete_button'  class='btn none btn-danger btn-sm rounded-0' type='submit' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i></button>

                                </form>
                                </td>
                                
                              </tr>";
                          }
                    
                      ?>
                    </tbody>
                  </table>
                </div>
        
              </div>
            </div>
            </div>
          </div>
         
        
    


    <script src="../scripts/themeChanger.js"></script>

         
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

  <!-- Page level custom scripts -->
  <script>

function del(){
  
   return confirm("Data will be deleted");

}

</script>



</body>

</html>