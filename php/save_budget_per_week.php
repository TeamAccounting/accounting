<?php
	require_once('../support/config.php');

	

	if(!empty($_POST['budget'])){
		
		$rowcount= $connection->myQuery("SELECT * FROM budget_per_week")->fetch(PDO::FETCH_ASSOC);
		// echo $rowcount;
		// die;

		$budget=$_POST['budget'];

		$id = $rowcount['id'];

		if(!empty($rowcount['id'])){

			
			$query= $connection->myQuery("UPDATE `budget_per_week` SET `budget` = '$budget' WHERE `id` = $id");
			setAlert("<strong>Sucessfully</strong> changed",'success');


			
			redirect('../budget_per_week.php');


		}else{
			

	
		
		$query = $connection->myQuery("INSERT INTO `budget_per_week` (`budget`) VALUES ('$budget')");


		setAlert("<strong>Sucessfully</strong> updated",'success');
			redirect('../budget_per_week.php');
		}
		
	}else{
			setAlert("<strong>Invalid</strong> input",'danger');
			redirect('../budget_per_week.php');
	}
	
	
?>