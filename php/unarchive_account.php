<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$id = $_GET['id'];
		$query = $connection->myQuery("UPDATE `accounts` SET `is_deleted` = '0' WHERE `accounts`.`acc_id` = $id");
		
		setAlert('<strong>Restored</strong>','success');
		redirect('../archived_accounts.php');
		
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>