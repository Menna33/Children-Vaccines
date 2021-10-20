<?php 

require './helpers/dbConnection.php';
require './helpers/validator.php';


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