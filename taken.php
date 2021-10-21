<?php 
require './helpers/dbConnection.php';
require './helpers/validator.php';
if(!(isset($_SESSION['nurse']))) {
  //echo "nnnnnnnnn";
  if (isset($_SESSION['data_employee']))
  {
    //echo "mmmmmmm";
    header("Location: data_employee.php");
    //exit;
  }
  elseif (isset($_SESSION['health_employee']))
  {
    header("Location: health_employee.php");
    //exit;
  }
  elseif (isset($_SESSION['admin']))
  {
    header("Location: admin.php");
    //exit;
  }
  else
  {
    header("Location: login.php");
  exit;
  }
}
$id = $_GET['id'];

if(!validate($id,5)){
  $Message = "Invalid Id";
  echo '$Message: '.$Message;
  $_SESSION['Message'] = $Message;
  //header("Location: nurse.php");
} 
 $sql = "update babiesvaccines set taken=1 where id=$id";
 $op  = mysqli_query($con,$sql); 
 if($op){
    $_SESSION['Message'] = ["Vaccine is taken, Thank You :)"];

}else{
    $_SESSION['Message'] = [ "Error Try Again"];
}
 ?>
