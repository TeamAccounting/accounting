<?php
	require_once('support/config.php');
	if(loggedId()){
		redirect('dash.php');
	}else{
		addHead();
	};
?>







<div class="login-box box box-solid box-primary" style="background-color:#3c8dbc;" align= "center">
	<div class="login-box-header" style="color:#fff;" ><strong><h3>SGTSI Accounting System</h3></strong></div>
		
	<div class="login-box-body">
		<h4>Login to your Account</strong></h4><br>
		<div class="form-horizontal" >
		<?php
			Alert();
			unsetAlert();
		?>
			<form method="POST" action='php/LoggingIn.php'>
				<div class="has-feedback">
				<input class="form-control" type="text"  name="username" placeholder="Username" required></input>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="has-feedback" style="margin-top:1px;">
				<input class="form-control" type="password" name="password" placeholder="Password" required></input>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<br>
				<button type="submit" class="form-control btn btn-primary">Log In</button>
				<a href="forgot_password.php"><h5>Forgot Password?</strong></h5></a>
				
			</form>
		</div>
		
		
	</div>
</div>




<?php
	addFoot();
?>
