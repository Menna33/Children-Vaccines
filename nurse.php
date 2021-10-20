<?php ?>
<html>
<head>
<title>Nurse</title>
<link rel="stylesheet" href="./css/styles.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
     <div> </div>
    <!-- Login Form -->
    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
                    <label for="nationalID" class="col-sm-3 control-label">National ID For Baby* </label>
                    <div class="col-sm-9">
                        <input type="number" name="nationalID"  id="nationalID" placeholder="National ID" class="form-control">
                    </div>
                </div>
      <input type="submit" class="fadeIn fourth" value="Go">
    </form>



  </div>
</div>
</body>
</html>