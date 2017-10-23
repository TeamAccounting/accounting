<?php

	require_once('support/config.php');
	if(loggedId()){
		addHead('General Journal');
		// addNavBar();
		// addSideBar();
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
			Alert("User Added.","success");
			redirect("approval_flow.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("approval_flow.php");
			die;
		}
	}
?>