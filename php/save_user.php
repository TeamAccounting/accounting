<?php
	require_once('../support/config.php');
	if(loggedId()&&isset($_POST['username'] )){

		// var_dump($_POST);
		// die;
		
		$username=$_POST['username'];
		$rowcount= $connection->myQuery("SELECT * FROM users where username = '$username'")->rowcount();
		
		
		if($rowcount>0){
			setAlert("<strong>Uhh ohh</strong> username already exist",'danger');
			redirect('../frm_department.php');
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