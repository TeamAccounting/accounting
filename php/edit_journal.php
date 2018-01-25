<?php
	require_once('../support/config.php');
		if(isset($_POST['date'])&&isset($_POST['desc'])&&isset($_POST['id'])){
			$journaldate=$_POST['date'];
			$date=new DateTime($journaldate);
			echo $newdate = $date->format('Ym');
			$desc=$_POST['desc'];
			$journal_id=$_POST['id'];
			$rowcount= $connection->myQuery("SELECT * FROM journals where DATE_FORMAT(journal_date,'%Y%m') = $newdate AND journal_id != $journal_id")->rowcount();
			echo $rowcount;
			// die;
			
		
		if($rowcount>0){
			setAlert("<strong>Uhh ohh!</strong> The date and year chosen has a journal already",'danger');
			redirect('../edit_journal_form.php?id='.$journal_id);
			
		}else{
			$journaldate = $_POST['date'];
			$date = new DateTime($journaldate);
			$newdate = $date->format('Y-m-d');
			$query= $connection->myQuery("UPDATE `journals` SET `journal_date` = '$newdate', `description` = '$desc' WHERE `journals`.`journal_id` = $journal_id");
			setAlert("<strong>Sucessfully</strong> edited a journals details",'success');
			redirect('../edit_journal_form.php?id='.$journal_id);
		}
		
	}else{
		redirect('../index.php');
	}
?>