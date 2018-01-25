<?php
	require_once('../support/config.php');
	if(isset($_POST['acctno']) && isset($_POST['acctname']) && isset($_POST['accttype'])){
		var_dump($_POST);
		$acct_no=$_POST['acctno'];
		$acct_name=$_POST['acctname'];
		$rowcount= $connection->myQuery("SELECT * FROM `accounts` WHERE `account_name` = '$acct_name' AND `acc_id` != '$acct_no'")->rowcount();
		// die;
		if($rowcount>0){
			setAlert("<center><strong>Uhh ohh!</strong> The account number and account name chosen was existing already</center>",'danger');
			redirect('../chart_of_accounts.php?id='.$acct_no);
			
		}else{
		$acct_no=$_POST['acctno'];
		$acct_name=$_POST['acctname'];
		$acct_type=$_POST['accttype'];

		$query = $connection->myQuery("INSERT INTO `accounts` (`acc_id`, `account_name`, `type`, `is_deleted`) VALUES ( '$acct_no', '$acct_name', '$acct_type', '0')");
		setAlert("<strong>Registered</strong> a new account",'success');
		redirect('../chart_of_accounts.php');
		}

	}else{
		redirect('../index.php');
	}
	
?>