<?php
require './helpers/dbConnection.php';
require './helpers/validator.php';
$sql = "select * from roles";
$op  =  mysqli_query($con,$sql);
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

if($_SERVER['REQUEST_METHOD'] == "POST"){

$name     =  clean($_POST['name']); 
$password =  clean($_POST['password']);
$role_id=$_POST['roles'];
$errors = [];

#Name Valdiation
if(!validate($name,1)){
    $errors['Name'] = "Field Required";
 }
 if(!validate($name,7)){
   $errors['Name'] = "Name must be string";
}

#Password Valdiation
if(!validate($password,1)){
    $errors['password'] = "Field Required";
 }
 if(!validate($password,3)){
   $errors['password'] = "The password should be at least 6 characters";
}
# Gender Validation ... 
if(isset($_POST['gender'])){
    $gender= clean($_POST['gender']);
  }
  else{$errors['gender'] = "Field Required";}
  
if(count($errors) > 0){
 foreach($errors as $key => $val ){
     echo '* '.$key.' :  '.$val.'<br>';
 }
}else{
    $password = md5($password);
    $sql = "insert into employees (name,password,gender,role_id) values ('$name','$password',$gender,$role_id)";

    $op  =  mysqli_query($con,$sql);
   
     //echo   mysqli_error($con);
       //exit();
   
    if($op){
        echo 'Data Inserted';
        header("Location: admin.php");
    }else{
        echo 'Error in DB Try Again';
    }
   
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
<div class="container">
  <h2>Register</h2>
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"   enctype ="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text"  name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password"   name = "password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
                <label for="exampleInputPassword1">Gender</label>
                <br>
                <input type="radio" name="gender" value=0>
                <label for="exampleInputPassword1">Male</label>
                <br>
                <input type="radio" name="gender" value=1>
                <label for="exampleInputPassword1">Female</label>

            </div>
  <label for="roles">Role:</label>
  <?php 
//     $sql = "select * from roles";
//     $op  =  mysqli_query($con,$sql);
//     echo mysqli_error($con);
//  exit();
    ?>
<select name="roles" id="roles">
    <?php 
    while($role_data=mysqli_fetch_assoc($op))
    {
        ?>
        <option value="<?php echo $role_data['id'];?>"> <?php echo $role_data['title'];?></option>
   <?php }
   ?>
  
</select>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>

</body>
</html>
<?php 
 # close connection ... 
 mysqli_close($con);
 ?>