<?php 
require './helpers/dbConnection.php';
require './helpers/functions.php';
require './helpers/validator.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $password  =  clean($_POST['password']);
    $name      =  clean($_POST['name']);
    $errors = [];
          # Password Validation ... 
      if(!validate($password,1)){
          $errors['Password'] = "Field Required";
      }elseif(!validate($password,3) ){
          $errors['Password'] = "Password Length Must >= 6 ch";
      }
    
        # Name Validation ... 
        if(!validate($name,1)){
          $errors['Name'] = "Field Required";
      }elseif(!validate($name,7)){
          $errors['Name'] = "Name must be string";
      }
      if(count($errors) > 0){
          foreach($errors as $key => $val ){
              echo '* '.$key.' :  '.$val.'<br>';
          }
      }else{
          
         // db code .... 
    
         $password = md5($password);
        echo 'password: '.$password.'<br>';
        echo 'password: '.md5('123456');
         $sql = "select * from employees where name = '$name' and password = '$password'";
         $op  =  mysqli_query($con,$sql);
        /*echo mysqli_error($con);
        exit();*/
    
          if(mysqli_num_rows($op) == 1){
              // code 
            $data = mysqli_fetch_assoc($op);
            //print_r($data);
            if($data['role_id']==1)
            {
              $_SESSION['nurse'] = $data;
    
             header("Location: nurse.php");
            } 
            elseif($data['role_id']==2)
            {
              $_SESSION['data_employee'] = $data;
    
             header("Location: data_employee.php");
            } 
            elseif($data['role_id']==3)
            {
              $_SESSION['health_employee'] = $data;
    
             header("Location: health_employee.php");
            } 
            elseif($data['role_id']==4)
            {
              $_SESSION['admin'] = $data;
    
             header("Location: admin.php");
            } 
          }else{
              echo '<p style="color:red;"><b>'.'Error in Your Account Data , Try Again.'.'</b></p>';
          }
         # close connection ... 
         mysqli_close($con);
    
         }
    }
?>


<html>
<head>
<title>Log In</title>
<link rel="stylesheet" href="./css/styles.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
     <div> </div>
    <!-- Login Form -->
    <form   method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <input type="text" id="login" class="fadeIn first" name="name" placeholder="Name">
      <input type="text" id="password" class="fadeIn second" name="password" placeholder="Password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
  </div>
</div>
</body>
</html>