<?php

	  require_once('support/config.php');
	  if(loggedId()){

	  }else{
	    redirect('index.php');
	    setAlert('Please log in to continue','danger');
	  }
	  if (empty($_GET['id'])) {
	  	redirect('index.php');
	    
	  }
	  
	  	$request_id = $_GET['id'];
		$user_id = $_SESSION[APPNAME]['UserId'];

		// $approver_id=$connection->myQuery("SELECT * FROM approval_flow WHERE user_id=".$user_id)->fetch(PDO::FETCH_ASSOC);

		// echo $approver_id['id'];

		

		if (!empty($request_id)) {
			$connection->myQuery("UPDATE `cash_request` SET `status_id` = '3' WHERE `id` = $request_id");

		
		}

		setAlert('Request Successful Rejected','danger');
		
		redirect('cash_approval.php');
	
	
	
?>