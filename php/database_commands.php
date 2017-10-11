<?php

	
	if(isset($_REQUEST)){
		require_once("../support/config.php");
		if($_REQUEST['command']=='backup'){
			backUp($server_name, $username, $database);
			
		}
		if($_REQUEST['command']=='restore'){
			restore($server_name, $username, $database,$_REQUEST['filename']);
		}
	}
	
	
?>