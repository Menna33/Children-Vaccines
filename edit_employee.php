<?php

require './helpers/dbConnection.php';
require './helpers/validator.php';
require './helpers/functions.php';
# Fetch Old Data .... 

$id = $_GET['id'];

if(!validate($id,5)){
  $Message = "Invalid Id";
  $_SESSION['Message'] = $Message;
  header("Location: admin.php");
}
# Fetch departments .... 
$sql1= "select * from roles";
$role_data_op = mysqli_query($con,$sql1); 

#  Query to Fetch Data ... 
$sql = "select * from employees where id = $id";
$op  = mysqli_query($con,$sql);
$employee_data = mysqli_fetch_assoc($op);
/*print_r($employee_data);
echo mysqli_error($con);
exit();*/

if($_SERVER['REQUEST_METHOD'] == "POST"){

 $name = clean($_POST['name']); 
 $password = clean($_POST['password']);
 $role = clean($_POST['role']); 
 $errors = [];

   if(!validate($name,1)){
     $errors['name'] = "Required Field";
   }elseif(!validate($name,7)){
    $errors['Name'] = "Name must be string";
}
if(!validate($password,1)){
    $errors['password'] = "Required Field";
  }elseif(!validate($password,3)){
   $errors['password'] = "Password must be >=6 characters";
}
   if(!validate($role,1)){
    $errors['role'] = "Required Field";
  }

   if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
   }else{
     // DB OP .... 
     $sql = "update employees set name = '$name',password='$password',role_id='$role_id' where id = $id";
     $op  = mysqli_query($con,$sql);
     /*echo mysqli_error($con);
exit();*/
     if($op){
         $_SESSION['Message'] = ["Data Updated"];

         header("Location: admin.php");
         
         exit();

     }else{
         $_SESSION['Message'] = [ "Error Try Again"];
     }
   }
}

# Include UI Files ..... 
/*require '../layouts/header.php';

require '../layouts/topNav.php';*/


?>

<div id="layoutSidenav">


    <?php 

//require '../layouts/sidNav.php';

?>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">  
                
                    <?php 
                         $txt = "Dashboard / Edit Role"; 
                         printMessages($txt);
                   ?>
                
                </li>
                </ol>
                <div class="container">
                    <form action="edit_employee.php?id=<?php echo $employee_data['id'];?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Employee Name" value="<?php echo $employee_data['name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="number" name="password" class="form-control" id="exampleInputAge"
                                aria-describedby="" placeholder="Enter Password" value="<?php echo $employee_data['password'];?>">
                        </div>
                        <div class="form-group">
                <label for="exampleInputPassword1">Role</label>
                <select  name="role_id" class="form-control" >
                 <?php 
                    while($data = mysqli_fetch_assoc($role_data_op)){ 
                 ?>
                 
                 <option value="<?php echo $data['id'];?>">  <?php echo $data['title']; ?>  </option>

                 <?php } ?>
            </select> 
            </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </main>
        <?php 
 
 //require '../layouts/footer.php';
 
 ?>