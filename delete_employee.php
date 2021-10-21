<?php 

require './helpers/dbConnection.php';
require './helpers/validator.php';
if(!(isset($_SESSION['admin']))) {
    //echo "nnnnnnnnn";
    if (isset($_SESSION['nurse']))
    {
      //echo "mmmmmmm";
      header("Location: nurse.php");
      //exit;
    }
    elseif (isset($_SESSION['data_employee']))
    {
      header("Location: data_employee.php");
      //exit;
    }
    elseif (isset($_SESSION['health_employee']))
    {
      header("Location: health_employee.php");
      //exit;
    }
    else
    {
      header("Location: login.php");
    exit;
    }
  }

$id = $_GET['id'];

if(validate($id,5)){

    // code ...... 
  $sql = "delete from employees where id = $id";
  $op  = mysqli_query($con,$sql);
  
  if($op){
      $Message = "Row removed";
  }else{
      $Message = "Error Try Again";
  }

}else{

    $Message = "Invalid Id";

}


$_SESSION['Message'] = [$Message];

header("Location: admin.php");




?>