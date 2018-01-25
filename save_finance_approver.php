<?php
	require_once('support/config.php');

	

	if(!empty($_POST['finance_id'])){
		
		$rowcount= $connection->myQuery("SELECT * FROM finance_approver")->fetch(PDO::FETCH_ASSOC);
		// echo $rowcount;
		// die;

		$finance_id=$_POST['finance_id'];

		$id = $rowcount['id'];

		if(!empty($rowcount['id'])){

			
			$query= $connection->myQuery("UPDATE `finance_approver` SET `user_id` = '$finance_id' WHERE `id` = $id");
			setAlert("<strong>Sucessfully</strong> changed",'success');


			
			redirect('approval_Flow.php');


		}else{
			

	
		
		$query = $connection->myQuery("INSERT INTO `finance_approver` (`user_id`) VALUES ('$finance_id')");


		setAlert("<strong>Sucessfully</strong> updated",'success');
			redirect('approval_Flow.php');
		}
		
	}else{
		redirect('../index.php');
	}
	
	
?>