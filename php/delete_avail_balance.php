<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$id = $_GET['id'];
		$connection->myQuery("UPDATE `available_balance` SET `is_deleted` = '1' WHERE `id` = $id");
		setAlert("<center>Delete Successful!",'success');
		redirect('../available_balance.php');
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
	
	
?>