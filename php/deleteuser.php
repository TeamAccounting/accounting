<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$user_id = $_GET['id'];
		$connection->myQuery("UPDATE `users` SET `is_deleted` = '1' WHERE `users`.`user_id` = $user_id");
		redirect('index.php');
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
	
	
?>