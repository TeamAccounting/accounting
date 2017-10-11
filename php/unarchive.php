<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_GET['id'])){
		$journal_id = $_GET['id'];
		$query = $connection->myQuery("UPDATE `journals` SET `is_archived` = '0' WHERE `journals`.`journal_id` = $journal_id");
		
		setAlert('<strong>Restored</strong>','success');
		redirect('../archived_journals.php');
		
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>