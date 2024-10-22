<?php
$localhost='localhost';
$username='root';
$password='';
$databaseName='attendance system';

$conn=mysqli_connect($localhost,$username,$password,$databaseName);

if(!$conn){
die('connection failed');
}


?>