<?php
	require_once('support/config.php');
	// var_dump($_POST);
	// 	die;
	if(loggedId()&&isset($_POST['username'] )){

		var_dump($_POST);
		// die;
		$id = $_POST['id'];
		$username=$_POST['username'];
		
		$fullname=$_POST['name'];
		$password=encryptIt($_POST['password']);
		
		$sq = $_POST['security_question'];
		$ans = $_POST['answer'];

		$connection->myQuery("UPDATE `users` SET `full_name` = '$fullname', `password` = '$password', `security_question` = '$sq', `answer` = '$ans' WHERE `user_id` = $id");
		
		
		setAlert("<strong>Saved</strong> changes",'success');
		// die;
		redirect('myaccount.php');
		
	}else{
		
	}
?>