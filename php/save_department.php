<?php
	require_once('../support/config.php');
		
	if(loggedId()&&isset($_POST['dep_name'] )){
		// var_dump($_POST);
		

		//     die;
		if(empty($_POST['id'])) { 
			if (!is_numeric($_POST['allowance'])) {

				setAlert("<strong>Invalid</strong> allowance input",'danger');
				redirect('../frm_department.php');
				die;
		        // echo var_export($_POST['allowance'], true) . " is numeric", PHP_EOL;
		    } 

		    // die;

			$department=$_POST['dep_name'];
			$rowcount= $connection->myQuery("SELECT * FROM department where department_name = '$department'")->rowcount();
			
			
			if($rowcount>0){
				setAlert("<strong>Uhh ohh</strong> Department name already exist",'danger');
				redirect('../frm_department.php');
			}else{

			$dep_name=$_POST['dep_name'];
			$allowance=$_POST['allowance'];
			$dep_head=$_POST['dep_head'];
			
			$query = $connection->myQuery("INSERT INTO `department` (`department_name`, `allowance`, `department_head_id`) VALUES ('$dep_name', '$allowance', '$dep_head')");
			setAlert("<strong>Added</strong> a new department",'success');

		
			redirect('../department.php');

			}
		}else{
			$id = $_POST['id'];
			$dep_name=$_POST['dep_name'];
			$allowance=$_POST['allowance'];
			$dep_head=$_POST['dep_head'];

			if (!is_numeric($_POST['allowance'])) {

				setAlert("<strong>Invalid</strong> allowance input",'danger');
				redirect('../frm_department.php?department_id='.$id);
				die;
		        // echo var_export($_POST['allowance'], true) . " is numeric", PHP_EOL;
		    } 
		
			

			$connection->myQuery("UPDATE `department` SET `department_name` = '$dep_name', `allowance` = '$allowance', `department_head_id` = '$dep_head' WHERE `id` = $id");
			setAlert("<strong>Sucessfully</strong> changed department info",'success');
			redirect('../frm_department.php?department_id='.$id);
			die;
		
		}

	}
?>