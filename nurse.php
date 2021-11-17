
<?php 
require './helpers/dbConnection.php';
require './helpers/validator.php';
//print_r($_SESSION['nurse']);
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
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $nationalID = clean($_POST['nationalID']);
  $errors = [];
  # nationalID Validation ... 
 if(!validate($nationalID,1)){
  $errors['nationalID'] = "Field Required";
}elseif(!validate($nationalID,9)){
  $errors['nationalID'] = "nationalID must be int";
}elseif(!validate($nationalID,10)){
  $errors['nationalID'] = "National ID length must be 14";
}
if(count($errors) > 0){
  foreach($errors as $key => $val ){
      echo '* '.$key.' :  '.$val.'<br>';
  }
}else{

 //$sql = "select vaccines.name, babies.name as babyName from vaccines join babiesvaccines on vaccines.id = babiesvaccines.vaccine_id join babies on babies.national_id=babiesvaccines.baby_id";
 $sql = "select vaccines.name,babiesvaccines.id from vaccines join babiesvaccines on vaccines.id = babiesvaccines.vaccine_id and babiesvaccines.baby_id=$nationalID and babiesvaccines.taken=0";
 /*SELECT t1.col, t3.col
FROM table1
JOIN table2 ON table1.primarykey = table2.foreignkey
JOIN table3 ON table2.primarykey = table3.foreignkey*/
 $op  = mysqli_query($con,$sql); 
 
 /*echo mysqli_error($con);
     exit();*/
?>
     <div class="container" style="background: white;">
     <h3 style="color:#428bca;">Vaccines for the National ID <?php echo $nationalID?> are :</h3>
     <?php
     if($data = mysqli_fetch_assoc($op))
     { 
       ?>  
       <b><p style="color:#428bca;"><?php echo $data['name']?></p></b>
       <a class="btn btn-primary" href='taken.php?id=<?php echo $data['id'];?>' role="button">Taken</a>
            
        <?php
 while($data = mysqli_fetch_assoc($op))
 { 
   ?>  
<b><p style="color:#428bca;"><?php echo $data['name']?></p></b>
<a class="btn btn-primary" href='taken.php?id=<?php echo $data['id'];?>' role="button">Taken</a>
     
 <?php
 }}
 else{?>
  <b><p style="color:#428bca;">There are no vaccines for that national ID </p></b>
<?php } ?>
 </div> 
 <?php 
 # close connection ... 
 mysqli_close($con);
 }
}
  
?>
<html>
<head>
<title>Nurse</title>
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
    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
                    <label for="nationalID" class="col-sm-3 control-label">National ID For Baby* </label>
                    <div class="col-sm-9">
                        <input type="number" name="nationalID"  id="nationalID" placeholder="National ID" class="form-control">
                    </div>
                </div>
      <input type="submit" class="fadeIn fourth" value="View Vaccine">
    </form>
  </div>
</div>
</body>
</html>