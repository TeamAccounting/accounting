<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$journal_id = $_GET['id'];
		$query = $connection->myQuery("UPDATE `journals` SET `is_archived` = '1' WHERE `journals`.`journal_id` = $journal_id");
		
		setAlert('<strong>Archived</strong>','danger');
		redirect('../general_journal.php');
		
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>