<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$id = $_GET['id'];
		$query = $connection->myQuery("UPDATE `accounts` SET `is_deleted` = '1' WHERE `accounts`.`acc_id` = $id");
		
		setAlert('<strong>Archived</strong>','danger');
		redirect('../chart_of_accounts.php');
		
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>