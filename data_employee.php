<?php  
require './helpers/dbConnection.php';
require './helpers/validator.php';
//include('Math/BigInteger.php');
/*if($_SESSION['data_employee']['role_id']!=2)
{
    if($_SESSION['data_employee']['role_id']==1)
    {
        header("Location: nurse.php");
    }
    elseif($_SESSION['data_employee']['role_id']==3)
    {
        header("Location: health_employee.php");
    }
    elseif($_SESSION['data_employee']['role_id']==4)
    {
        header("Location: admin.php");
    }

}*/
if($_SERVER['REQUEST_METHOD'] == "POST"){

$name       =  clean($_POST['name']); 
$email      =  clean($_POST['email']);
$nationalID = clean($_POST['nationalID']);
//echo 'nationalID: '.$nationalID.'<br>';
//$phoneNumber=  clean($_POST['phoneNumber']);
$parentName=   clean($_POST['parentName']);
//strlen($input) != 14
  /*echo var_dump($nationalID1); 
  echo var_dump($nationalID2); 
   exit();*/
$errors = [];
#Name Valdiation
  if(!validate($name,1)){
     $errors['Name'] = "Field Required";
  }
  if(!validate($name,7)){
    $errors['Name'] = "Name must be string";
 }
#parentName Valdiation
if(!validate($parentName,1)){
    $errors['parentName'] = "Field Required";
 }
 if(!validate($parentName,7)){
   $errors['parentName'] = "Name must be string";
}
 # Email Validation ... 
    if(!validate($email,1)){
      $errors['Email'] = "Field Required";
  }elseif(!validate($email,2)){
      $errors['Email'] = "Invalid Email";
  }
 # nationalID Validation ...
 # nationalID Validation ... 
 if(!validate($nationalID,1)){
    $errors['nationalID'] = "Field Required";
}elseif(!validate($nationalID,9)){
    $errors['nationalID'] = "nationalID must be int";
}elseif(!validate($nationalID,10)){
    $errors['nationalID'] = "National ID length must be 14";
}

# Gender Validation ... 
if(isset($_POST['gender'])){

  $gender     =  clean($_POST['gender']);
  }else{
    $errors['gender'] = "Field Required";
  }

  if(count($errors) > 0){
      foreach($errors as $key => $val ){
          echo '* '.$key.' :  '.$val.'<br>';
      }
  }else{
     // db code .... 
     $sql = "insert into babies (national_id,name,gender,parent_name,parent_email) values ('$nationalID','$name','$gender','$parentName','$email')";
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

// CRUD   C >>> Create 

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
<title>ِAdd New Baby</title>
<link rel="stylesheet" href="./css/new_baby.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
<div class="container">
            <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                <h2 style="color:#428bca;">Add New Baby</h2>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name*</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="name" placeholder="Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nationalID" class="col-sm-3 control-label">National ID* </label>
                    <div class="col-sm-9">
                        <input  id="nationalID" type="number" name="nationalID" placeholder="National ID" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" >Gender*</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" name="gender" value="Female">Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" name="gender" value="Male">Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Parent Name*</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="parentName" placeholder="Name" class="form-control" autofocus>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Parent Email* </label>
                    <div class="col-sm-9">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" name= "email">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><b>Add Baby</b></button>
            </form> <!-- /form -->
        </div> <!-- ./container -->
</body>
</html>