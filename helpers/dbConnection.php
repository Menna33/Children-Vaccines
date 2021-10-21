<?php 
session_start();

$server     = "localhost";
$dbName     = "babies_vaccines";
$dbUser     = "root";
$dbPassword = "";

   # Create Connection ... 
   $con =   mysqli_connect($server,$dbUser,$dbPassword,$dbName,3307);

   if(!$con){

       die('Error '.mysqli_connect_error());
   }


?>