<?php

	require_once('support/config.php');
	if(loggedId()){
		addHead('General Journal');
		// require_once("templates/navbar.php");
		// require_once("templates/sidebar.php");
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
	var_dump($_POST);
	
	if(empty($_POST['user_id'])){
		Alert("Invalid User","danger");
		redirect("approval_flow.php");
		die;
	}
	else{
		$connection->beginTransaction();
		try {
			$connection->myQuery("INSERT INTO approval_flow(user_id) VALUES(?)",array($_POST['user_id']));
			$connection->commit();
			setAlert("User Added.","success");
			redirect("approval_flow.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			setAlert('Please try again.',"danger");
			redirect("approval_flow.php");
			die;
		}
	}
?>