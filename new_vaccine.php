<?php  
require './helpers/dbConnection.php';
require './helpers/validator.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

$name       =  clean($_POST['name']); 
$age      =  clean($_POST['age']);

$errors = [];
#Name Valdiation
  if(!validate($name,1)){
     $errors['Name'] = "Field Required";
  }
  if(!validate($name,7)){
    $errors['Name'] = "Name must be string";
 }
#Age Validation
if(!validate($age,1)){
    $errors['age'] = "Field Required";
 }
 if(validate($age,7)){
   $errors['age'] = "Age must be integer";
}

  if(count($errors) > 0){
      foreach($errors as $key => $val ){
          echo '* '.$key.' :  '.$val.'<br>';
      }
  }else{
      
     // db code .... 
     $sql = "insert into vaccines (name,age) values ('$name',$age)";
     $op  =  mysqli_query($con,$sql);
     /*echo mysqli_error($con);
     exit();*/
     if($op){
        echo "Data Inserted";
    }
    else{
         echo 'Error Try Again';
      }
     # close connection ... 
     mysqli_close($con);

     
     }
}


?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<title>ِAdd New Vaccine</title>
<link rel="stylesheet" href="./css/new_baby.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<div class="container">
            <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                <h2 style="color:#428bca;">Add New Vaccine</h2>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name*</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="name" placeholder="Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-3 control-label">Age* </label>
                    <div class="col-sm-9">
                        <input  id="nationalID" type="number" name="age" placeholder="Age by months" class="form-control">
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><b>Add Vaccine</b></button>
            </form> <!-- /form -->
        </div> <!-- ./container -->
</html>