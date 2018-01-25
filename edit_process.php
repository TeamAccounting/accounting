<?php

	  require_once('support/config.php');



	  if(loggedId()){

	  }else{
	    redirect('index.php');
	    setAlert('Please log in to continue','danger');
	  }
	
	if(empty($_POST['user_id'])){
		Alert("Invalid approval process.","danger");
		redirect("approval_flow.php");
		die;
	}
	else{
		$connection->beginTransaction();
		try {
			$connection->myQuery("DELETE FROM approval_flow");
			foreach ($_POST['user_id'] as $key => $user) {
				$connection->myQuery("INSERT INTO approval_flow(user_id) VALUES(?)",array($user));

				// Alert('Saved successful.',"success");
			}
			// throw new Exception("Error Processing nope", 1);
			
			$connection->commit();
			setAlert("Save succesful","success");
			redirect("approval_flow.php");
			
		} catch (Exception $e) {
			$connection->rollBack();
			die($e->getMessage());
			setAlert('Please try again.',"danger");
			redirect("approval_flow.php");
			die;
		}
	}
?>