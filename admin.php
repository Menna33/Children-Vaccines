<?php
require './helpers/dbConnection.php';
$sql="select employees.*,roles.title from employees left join roles on employees.role_id=roles.id";
$op=mysqli_query($con,$sql);
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
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="./css/health_emp.css">
<?php //<link rel="stylesheet" href="styles.css">?>
</head>
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
<section class="tiles">
	<div class="container">
		<div class="row">
			<h2>What action do you want to do? </h2>
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<div class="link-tiles"><a href='new_employee.php'>Add New Employee</a></div>
        </div>
				<div class="col-md-3 col-sm-4">
					<div class="link-tiles"><a href='send_notification.php'>Send Notification</a></div>
					<!--.link-tiles-->
				</div>
				<div class="container">
        <!-- PHP code to read records will be here -->
        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>Employee Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>


     <?php 
          while($data = mysqli_fetch_assoc($op)){
       
     ?>

            <tr>

              <td><?php echo $data['name'];?></td>

              <td><?php if(isset($data['title']) ){   echo $data['title'];   }else{  echo 'No role'; } ?></td>

              <td>
                    <a href='delete_employee.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit_employee.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
              </td>

            </tr>
   <?php } ?>
  

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->
				<?php
/*
				<div class="col-md-3 col-sm-4">
					<div class="link-tiles"><a href="#">Update Vaccine Info</a>
					</div>
					<!--.link-tiles-->
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="link-tiles"><a href="#">Delete Vaccine</a>
					</div>
					<!--.link-tiles-->
				</div>
				*/?>
			</div>
		</div>
		<!--.row-->
	</div>
	<!--.container-->
</section>
            </section>
</body>
</html>