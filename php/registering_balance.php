<?php
	require_once('../support/config.php');
	if(isset($_POST['year']) && isset($_POST['amount'])){
		
		$year=$_POST['year'];
		$amount=$_POST['amount'];
		$rowcount= $connection->myQuery("SELECT * FROM `available_balance` where `year` = '$year' and `is_deleted`=0")->rowcount();

		if($rowcount>0){
			setAlert("<center><strong>Input Year Already Exists: ".$year,'danger');
			redirect('../available_balance.php');
			
		}else{
		$query = $connection->myQuery("INSERT INTO `available_balance` (`year`, `amount`) VALUES ( '$year', '$amount')");
		setAlert("Register Successful!",'success');
		redirect('../available_balance.php');
		}

	}else{
		redirect('../index.php');
	}
	
?>