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

		$approver_id=$connection->myQuery("SELECT * FROM approval_flow WHERE user_id=".$user_id)->fetch(PDO::FETCH_ASSOC);

	
		if (!empty($approver_id['id'])) {
			$next_approver=$connection->myQuery("SELECT * FROM approval_flow WHERE id > ".$approver_id['id']." ORDER BY id LIMIT 1")->fetch(PDO::FETCH_ASSOC);

			echo $next_approver_id = $next_approver['user_id'];
			

			if (!empty($next_approver['id'])) {
				$connection->myQuery("UPDATE `cash_request` SET `approver_id` = $next_approver_id WHERE `id` = $request_id");

			} else {

				$finance=$connection->myQuery("SELECT * FROM finance_approver LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				var_dump($finance);

				echo $finance_id = $finance['user_id'];


				$connection->myQuery("UPDATE `cash_request` SET `approver_id` = $finance_id WHERE `id` = $request_id");

			
			}
		}
		else {

			

			$cjay_id=$connection->myQuery("SELECT journal_details_id from cash_request WHERE id =".$request_id)->fetch(PDO::FETCH_ASSOC);

    		$journal_id=explode(",", $cjay_id['journal_details_id']);

    		for($x = 0; $x <= count($journal_id)-1; $x++) {
		      echo $journal_id[$x];

		      $connection->myQuery("UPDATE `journal_details` SET `status_id` = '2' WHERE `id` = $journal_id[$x]");
		    }

    		// die;
			$connection->myQuery("UPDATE `cash_request` SET `status_id` = '2' WHERE `id` = $request_id");	    		

			$journal_details=$connection->myQuery("SELECT * FROM cash_request WHERE id=".$request_id)->fetch(PDO::FETCH_ASSOC);

			$journalentry_id=$journal_details['journal_entry_no'];			
			$journal_num=$journal_details['journal_id'];
			$newDate=$journal_details['date_of_entry'];
			$entry_desc=$journal_details['description'];

			$connection->myQuery("INSERT INTO `journal_entries` (`journal_entry_no`, `journal_id`, `date_of_entry`, `description`) VALUES ('$journalentry_id', '$journal_num','$newDate','$entry_desc')");

			// die;
				
		}
		setAlert('Approved Successful','success');
		
		redirect('cash_approval.php');
	
	
	
?>