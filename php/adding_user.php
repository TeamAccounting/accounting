<?php
	require_once('../support/config.php');
	var_dump($_POST);
	// die;
	if(!empty($_POST['username'] )){
		
		$username=$_POST['username'];
		echo $rowcount= $connection->myQuery("SELECT * FROM users where username = '$username' AND is_deleted='0'")->rowcount();
		// die;
		
		if($rowcount>0){

			setAlert("<strong>Uhh ohh</strong> Username already exist",'danger');
			redirect('../users.php');
		}else{
		$fullname=$_POST['fullname'];
		$password=encryptIt($_POST['password']);
		$account=$_POST['account'];
		
		$query = $connection->myQuery("INSERT INTO `users` (`user_id`, `full_name`, `username`, `password`, `user_type`, `is_deleted`, `is_logged_in`) VALUES (NULL, '$fullname', '$username', '$password', '$account', '0', '0')");
		setAlert("<strong>Added</strong> a new account",'success');

		
		redirect('../users.php');
		}


	}else{
		
	}
?>