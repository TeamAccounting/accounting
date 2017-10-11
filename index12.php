<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Accounting System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="css/stylesheet.css">
  <link rel="stylesheet" href="AdminLTE-2.3.5/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE-2.3.5/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="AdminLTE-2.3.5/dist/css/skins/_all-skins.min.css">

	</head>
	


<body class="skin-blue">




<div class="login-box box box-solid box-primary" 	align= "center">
	<div class="box-header"><h3><?php
  	require_once("support/config.php");
  	echo "nigga";
  ?>
  </h3></div>

	<div class="box-body">
		<div class="form-horizontal" >
			<div class="input-group">
			<input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
			</div>
	
			<div class="input-group">
			<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2">
			</div>
			<br>
			
		</div>
		
		<button type="button" class="btn btn-primary">Log In</button>
		<button type="button" class="btn btn-danger">Cancel</button>
	</div>
</div>




<script src="AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>	
<!-- Bootstrap 3.3.6 -->
<script src="AdminLTE-2.3.5/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="AdminLTE-2.3.5/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-2.3.5/dist/js/app.min.js"></script>

</body>
</html>