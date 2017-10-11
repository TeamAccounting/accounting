<?php 
require_once('support/config.php');
	if(isset($_POST['entry_date']) && isset($_POST['entry_description'])){

	
	$journal_num = $_POST['JournalNumber'];
	$journalentry_id = $_POST['JournalID'];
	$entry_date = $_POST['entry_date'];
	$newDate = date("Y-m-d", strtotime($entry_date));
	$drnames=$_POST['drnames'];
	$drvalues=$_POST['drvalues'];
	$crnames=$_POST['crnames'];
	$crvalues=$_POST['crvalues'];
	$entry_desc=$_POST['entry_description'];
		
	
	$insert_journalentry = $connection->myQuery("INSERT INTO `journal_entries` (`id`, `journal_entry_no`, `journal_id`, `date_of_entry`, `description`) VALUES (NULL, '$journalentry_id', '$journal_num','$newDate','$entry_desc')");
	
	$insert_entry =("INSERT INTO `journal_details` (`id`, `account_id`, `journal_entry_no`, `amount`,`is_debit`) VALUES");
		
		for($x = 0; $x <= count($drnames)-1; $x++)
			{
				$insert_entry=$insert_entry.("(NULL, (SELECT `acc_id` FROM accounts WHERE account_name ='$drnames[$x]'), $journalentry_id ,$drvalues[$x],1),");
			}
		
		for($x = 0; $x <= count($crnames)-1; $x++)
			{
				$insert_entry=$insert_entry.("(NULL, (SELECT `acc_id` FROM accounts WHERE account_name = '$crnames[$x]'), $journalentry_id ,$crvalues[$x],0),");
			}
	
	$fin_entry =  trim($insert_entry, ",").";";
	
	$results = $connection -> myQuery($fin_entry);
	redirect("journal_entry.php?id=$journal_num");	
		 
	}else{
		redirect('../index.php');
	}
	
?>