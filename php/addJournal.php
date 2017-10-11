<?php
	require_once('../support/config.php');
	
	if(isset($_POST['date']) && isset($_POST['desc'])){
		
		$journaldate=$_POST['date'];
		$date=new DateTime($journaldate);
		$newdate = $date->format('Y-m-d');
		$journaldesc=$_POST['desc'];
		$query = $connection->myQuery("INSERT INTO `journals` (`journal_id`, `journal_date`, `description`, `ledger_id`) VALUES (NULL, '$newdate', '$journaldesc', '0')");
		redirect('../general_journal.php');
	}else{
	
		redirect('../index.php');
	}
	
?>