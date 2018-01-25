<?php
	require_once('../support/config.php');
		if(isset($_POST['amount'])&&isset($_POST['id'])){
			$amount=$_POST['amount'];
			$balance_id=$_POST['id'];
			//echo $rowcount;				
			$query= $connection->myQuery("UPDATE `available_balance` SET `amount` = '$amount' WHERE `id` = $balance_id");
			setAlert("<center>Edit Successful!",'success');
			redirect('../edit_available_balance.php?id='.$balance_id);
		}
		else{
		redirect('../index.php');
	}
?>