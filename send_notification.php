<?php
require './helpers/dbConnection.php';
require './helpers/validator.php';
$sql = "select * from babies";
$op  =  mysqli_query($con,$sql);
while($data=mysqli_fetch_assoc($op))
{
   $national_id=$data['national_id'];
   echo $national_id.'<br';
   //baby's birth date as string
   $year= '20'.substr($national_id,1,2); 
   $month= substr($national_id,3,2);
   $day= substr($national_id,5,2);
   echo $date1=($year.'-'.$month.'-'.$day);
  // $interval = new DateTime(date("Y-m-d"))->diff(new DateTime($date1));
  // echo 'interval: '.$interval;
   echo 'time: '.time();
   echo '<br>timeeee: '.strtotime($date1);

   /*echo strtotime($year.'-'.$month.'-'.$day);
   
   echo strtotime($day.'-'.$month.'-'.$year);*/

   //$date1 = new DateTime("2007-03-24");
/*$date2 = new DateTime("2009-06-26");
$interval = $date1->diff($date2);
echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

// shows the total amount of days (not divided into years, months and days like above)
echo "difference " . $interval->days . " days ";*/
/******************************** */
$now = time(); // or your date as well
$your_date = strtotime("2010-01-31");
$datediff = $now - $your_date;

echo round($datediff / (60 * 60 * 24));

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