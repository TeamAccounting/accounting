<?php
	require_once('../support/config.php');

	if(loggedId()&&isset($_GET['id'])){

		$dep_id = $_GET['id'];
		$connection->myQuery("UPDATE department SET is_deleted = '1' WHERE id = $dep_id");
		redirect('../department.php');
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
	
	
?>