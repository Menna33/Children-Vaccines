<?php 
require './helpers/dbConnection.php';
require './helpers/validator.php';
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
