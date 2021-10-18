<?php

require './helpers/dbConnection.php';
require './helpers/validator.php';
require './helpers/functions.php';
# Fech Old Data .... 

$id = $_GET['id'];

if(!validate($id,5)){

  $Message = "Invalid Id";

  $_SESSION['Message'] = $Message;

  header("Location: health_employee.php");

}

#  Query to Fetch Data ... 
$sql = "select * from vaccines where id = $id";
$op  = mysqli_query($con,$sql);
$Vaccine_data = mysqli_fetch_assoc($op);
/*print_r($Vaccine_data);
echo mysqli_error($con);
exit();*/

if($_SERVER['REQUEST_METHOD'] == "POST"){

 $name = clean($_POST['name']); 
 $age = clean($_POST['age']); 
    $errors = [];

   if(!validate($name,1)){
     $errors['name'] = "Required Field";
   }

   if(!validate($age,1)){
    $errors['age'] = "Required Field";
  }

   if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
   }else{
     // DB OP .... 
     $sql = "update vaccines set name = '$name',age=$age where id = $id";
     $op  = mysqli_query($con,$sql);
     /*echo mysqli_error($con);
exit();*/
     if($op){
         $_SESSION['Message'] = ["Data Updated"];

         header("Location: health_employee.php");
         
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
                    <form action="edit_vaccine.php?id=<?php echo $Vaccine_data['id'];?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Vaccine Name" value="<?php echo $Vaccine_data['name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Age</label>
                            <input type="number" name="age" class="form-control" id="exampleInputAge"
                                aria-describedby="" placeholder="Enter Vaccine Age" value="<?php echo $Vaccine_data['age'];?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </main>
        <?php 
 
 //require '../layouts/footer.php';
 
 ?>