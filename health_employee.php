<?php
require './helpers/dbConnection.php';
$sql="select * from vaccines";
$op=mysqli_query($con,$sql);
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="./css/health_emp.css">
<?php //<link rel="stylesheet" href="styles.css">?>
</head>
<body>
	<?php
/*<div class="row text-center grid3">
  <div class="col-xs-3">.col-md-4</div>
  <div class="col-xs-3">.col-md-4</div>
  <div class="col-xs-3">.col-md-4</div>
</div>*/?>

<section class="tiles">
	<div class="container">
		<div class="row">
			<h2>What action you want to do? </h2>
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<div class="link-tiles"><a href='new_vaccine.php'>Add New Vaccine</a>
					</div>
					<!--.link-tiles-->
				</div>
				<div class="container">
        <!-- PHP code to read records will be here -->
        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>Vaccine Name</th>
                <th>Age</th>
                <th>Action</th>
            </tr>


     <?php 
          while($data = mysqli_fetch_assoc($op)){
       
     ?>

            <tr>

              <td><?php echo $data['name'];?></td>

              <td><?php echo $data['age'];?></td>

              <td>
                    <a href='delete_vaccine.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit_vaccine.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
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