<?php
	require_once('support/config.php');
	if(empty($_POST['add'])){
		$add=$_POST['add'];
		$year=$_POST['year'];
		$amount=$_POST['bal'];
		$rowcount= $connection->myQuery("SELECT * FROM `available_balance` where `year` = '$year'")->rowcount();

		if($rowcount>0){
			$query = $connection->myQuery("UPDATE `available_balance` SET `amount`='$amount' WHERE `year`='$year'");
			setAlert("Save Successful!",'success');
			redirect('trial_balance.php');
			
		}else{
		$query = $connection->myQuery("INSERT INTO `available_balance` (`year`, `amount`) VALUES ( '$year', '$amount')");
		setAlert("Save Successful!",'success');
		redirect('trial_balance.php');
		}

	}else{
		$add=$_POST['add'];
		$year=$_POST['year1'];
		$amount=$_POST['totbal'];
		$cur_year=$year-1;
		$rowcount= $connection->myQuery("SELECT * FROM `available_balance` where `year` = '$year'")->rowcount();

		if($rowcount>0){
			$query = $connection->myQuery("UPDATE `available_balance` SET `amount`='$amount' WHERE `year`='$year'");
			setAlert("Save Successful!",'success');
			redirect('trial_balance.php');
			
		}else{
		$query = $connection->myQuery("INSERT INTO `available_balance` (`year`, `amount`) VALUES ( '$year', '$amount')");
		setAlert("Save Successful!",'success');
		redirect('trial_balance.php');
		}
		$query = $connection->myQuery("INSERT INTO `additional_cash` (`amount`, `year`) VALUES ( '$add', '$cur_year')");
	}
	
?>