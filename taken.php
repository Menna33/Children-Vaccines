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
/*$baby_id = $_GET['id'];
if(!validate($baby_id,5)){
  $Message = "Invalid Id";
  echo '$Message: '.$Message;
  $_SESSION['Message'] = $Message;
  //header("Location: nurse.php");
} */
$_SESSION['Message']=" Thank You, The taken vaccines are :";;
if($_SERVER['REQUEST_METHOD'] == "POST"){
 // $_SESSION['Message']="mennna: ".$_POST['vaccine'];
  //print_r($_POST['vaccine']);
  //exit();
  if(!empty($_POST['vaccine'])){
    // Loop to store and display values of individual checked checkbox.
    for($i=0; $i < count($_POST['vaccine']); $i++)
    {
      $selected= $_POST['vaccine'][$i];
    $baby_id=$_SESSION['baby_id'];
    $sql = "update babiesvaccines set taken=1 where vaccine_id=$selected and baby_id=$baby_id";

    $op  = mysqli_query($con,$sql); 
    if($op){
       
       $sql = "select name from vaccines where id=$selected";

       $op  = mysqli_query($con,$sql); 
       if($op){
        if($data = mysqli_fetch_assoc($op))
        { 
        $_SESSION['Message'].=$data['name'] ."<br>";
      }
       }
   }else{
     
       $_SESSION['Message'] = "Error Try Again";
       $_SESSION['Message'] ='$selected : '.$selected. '$baby_id : '.$baby_id;
   }
    }
    }
  
  }
 
 ?>
<html>
<head>
<title>Taken Vaccine</title>
<link rel="stylesheet" href="./css/styles.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
     <div> </div>
    <!-- Login Form -->
   <p><b> <?php  echo $_SESSION['Message']; ?> </b></p>
  </div>
</div>
</body>
</html>