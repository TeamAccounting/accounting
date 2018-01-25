<?php
	require_once 'support/config.php';



// var_dump($largest);
// die;
		if(!empty($_POST)){
		//Validate form inputs
		$inputs=$_POST;
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";

		// var_dump($inputs);
		// die;


		//echo $inputs['request_type']."</br>".$inputs['request_id'];
		//die();

		if(empty($_POST['request_id']))
		{
			Modal("Invalid Record Selected");
			redirect("index.php");
			die;
		}


				
			$connection->myQuery("INSERT INTO query_message(sender_id,receiver_id,query_id,message,date_sent) VALUES(:sender_id,:dep_head_id,:request_id,:reason,NOW())",$inputs);
				
			
			Alert("Message Sent.","success");
			redirect("department.php");
		
		die;
	}
	else{
		redirect('index.php');
		die();
	}
	redirect('index.php');
?>
