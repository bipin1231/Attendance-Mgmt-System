<?php
session_start();
$_SESSION["reg"] = $_GET['id'];;
header("location:viewStudentAttendance.php");
?>