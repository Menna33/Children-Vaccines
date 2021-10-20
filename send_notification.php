<?php
require './helpers/dbConnection.php';
require './helpers/validator.php';
$baby_sql = "select * from babies";
$baby_op  =  mysqli_query($con,$baby_sql);
$vaccine_sql = "select * from vaccines";
$vaccine_op  =  mysqli_query($con,$vaccine_sql);
echo   mysqli_error($con);
//exit();
while($data=mysqli_fetch_assoc($baby_op))
{
   $national_id=$data['national_id'];
   echo 'national_id: '.$national_id.'<br>';
   //baby's birth date as string
   $year= '20'.substr($national_id,1,2); 
   $month= substr($national_id,3,2);
   $day= substr($national_id,5,2);
   $birthDate=($year.'-'.$month.'-'.$day);
  /* echo '$birthDate'.$birthDate.'<br>';
   echo 'time: '.time().'<br>';
   echo '<br>timeeee: '.strtotime($birthDate).'<br>';*/
   $dateDiff = time() - strtotime($birthDate);
   $dateDiffByMonth=round($dateDiff / (60 * 60 * 24*30));
   /*echo round($dateDiff / (60 * 60 * 24)).'<br>'; //keda bigibo bel youm
   echo $dateDiffByMonth.'<br>'; //keda bigibo bel month*/
   $vaccine_data=mysqli_fetch_assoc($vaccine_op);
   //print_r($vaccine_data);
   $vaccine_data_array;
   while( $row = mysqli_fetch_assoc($vaccine_op))
{
    //echo '$row : '.$row['name'][0];
    $vaccine_data_array[$row['id']] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'age' => $row['age']
    );
}
//print_r($vaccine_data_array);
foreach ($vaccine_data_array as $row)
{
  //echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj<br>";
 // print_r ($row);
  //echo $row['age'];
  if($dateDiffByMonth== $row['age'])
  {
      echo "mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm".'<br>';
      //1-add new entry to babies' vaccines table
      $vaccine_id=$row['id'];
      $sql = "insert into babiesvaccines (baby_id,vaccine_id) values ($national_id,$vaccine_id)";

      $op  =  mysqli_query($con,$sql);
      if($op){
          echo 'Data Inserted into babies vaccines table';
      }else{
          echo 'Error in DB Try Again';
      }
      //2-send notification to parent
      $subject='Your Baby Vaccine Time';
      $content='Hello'.$data['parent_name'].'<br>'.'Your baby should take the vaccine';
      ini_set('display_errors', '1');
      mail($data['parent_email'],$subject, $content);
  }
  
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
<title>Send Notifications</title>
<link rel="stylesheet" href="./css/new_baby.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
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
</body>
</html>