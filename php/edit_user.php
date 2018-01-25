<?php
	require_once('../support/config.php');
	if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['account'])&&isset($_POST['id'])){
		$username=$_POST['username'];
		$users_id=$_POST['id'];
		$rowcount= $connection->myQuery("SELECT * FROM users where username = '$username' AND user_id != $users_id")->rowcount();
		//echo $rowcount;
		
		if($rowcount>0){
			setAlert("<strong>Uhh ohh</strong> Someone already has that username",'danger');
			redirect('../edit_userform.php?id='.$users_id);
			
		}else{
			
			$fullname=$_POST['name'];
			$account=$_POST['account'];
			$dep=$_POST['dep'];
			$password = encryptIt($_POST['password']);
			$query= $connection->myQuery("UPDATE `users` SET `full_name` = '$fullname', `username` = '$username', `password` = '$password', `user_type` = '$account', `department_id` = '$dep' WHERE `users`.`user_id` = $users_id");
			setAlert("<strong>Sucessfully</strong> changed user info",'success');
			redirect('../edit_userform.php?id='.$users_id);
		}
		
	}else{
		redirect('../index.php');
	}
	
	
?>