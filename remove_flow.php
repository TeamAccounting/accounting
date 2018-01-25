<?php
	require_once 'support/config.php';
	
	// if(!isLoggedIn()){
	// 	toLogin();
	// 	die();
	// }
    


	if(empty($_GET['id'])){
		Alert("Invalid user selected.","danger");
		redirect("approval_flow.php");
		die;
	}
	else{
		$connection->beginTransaction();
		try {
			$connection->myQuery("DELETE FROM approval_flow WHERE id=?",array($_GET['id']));
			// throw new Exception("Error Processing nope", 1);
			
			$connection->commit();
			Alert("Process updated.","success");
			redirect("approval_flow.php");
			die;
		} catch (Exception $e) {
			$connection->rollBack();
			die($e->getMessage());
			Alert('Please try again.',"danger");
			redirect("approval_flow.php");
			die;
		}
	}
?>