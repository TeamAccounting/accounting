<?php
	require_once('../support/config.php');
	if(isset($_POST['username'])&&isset($_POST['password'])){
	
		$userName=$_POST['username'];
		$password=encryptIt($_POST['password']);
		
		$query = $connection -> myQuery("SELECT * FROM users WHERE username='$userName' AND password='$password'")->fetch(PDO::FETCH_ASSOC);
		
		if($query['is_deleted']==0){
			if(!isset($_SESSION[APPNAME]['UserId'])){
				if($query['is_logged_in']==0){
					if(decryptIt($query['password'])==decryptIt($password)){
					//echo 'log in good';
						$_SESSION[APPNAME]['UserName']=$query['username'];
						$_SESSION[APPNAME]['FullName']=$query['full_name'];
						$_SESSION[APPNAME]['UserType']=$query['user_type'];
						$userId = $query['user_id'];
						$_SESSION[APPNAME]['UserId'] = $userId;
						$connection->myQuery("UPDATE `users` SET `is_logged_in` = '1' where user_id='$userId'");
						redirect('../dash.php');
					}else{
						setAlert('Wrong Username /Password','danger');
						redirect('../index.php');
					}
				}else{
					setAlert('User is logged in on another pc','danger');
					redirect('../index.php');
				}
			}else{
				if(decryptIt($query['password'])==decryptIt($password)){
					//echo 'log in good';
						$_SESSION[APPNAME]['UserName']=$query['username'];
						$_SESSION[APPNAME]['FullName']=$query['full_name'];
						$_SESSION[APPNAME]['UserType']=$query['user_type'];
						$userId = $query['user_id'];
						$_SESSION[APPNAME]['UserId'] = $userId;
						$connection->myQuery("UPDATE `users` SET `is_logged_in` = '1' where user_id='$userId'");
						redirect('../dash.php');
					}else{
						setAlert('Wrong Username /Password','danger');
						redirect('../index.php');
					}
			}
		}
		
	}else{
		redirect('../index.php');
	}
	
	
?>