<?php
require_once '../support/config.php';
//$con->myQuery("SELECT FROM comments c WHERE ");
$empty_message="No data available in table.";




if(!empty($_GET['id'])){
		$sender_id = $_SESSION[APPNAME]['UserId'];

		$messages=$connection->myQuery("SELECT message,
								(SELECT CONCAT(full_name) FROM users e WHERE e.user_id=sender_id) as sender,
								(SELECT CONCAT(full_name) FROM users e WHERE e.user_id=receiver_id) as receiver,
								date_sent,
								sender_id 
								FROM query_message 
								WHERE query_id=? ORDER BY date_sent DESC",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);

		//echo $_GET['request_type']."<br>".$_GET['id'];
		// var_dump($messages);
		// die();

		if(empty($messages)){
			echo $empty_message;
		}
		else{
			//echo "<ul class='timeline'>";
			echo "<div class='direct-chat-messages direct-chat-primary'>";
			foreach ($messages as $row):

				$connection->myQuery("UPDATE `query_message` SET `read` = '1' WHERE `receiver_id`= {$sender_id} AND `query_id` = ".$_GET['id']);
			?>
				<div class='direct-chat-msg <?php echo $row['sender_id']==$_SESSION[APPNAME]['UserId']?'right':''?>'>
					
				<div class='direct-chat-info clearfix'>
					<span class='direct-chat-name pull-left'><?php echo htmlspecialchars($row['sender']) ?></span>
					<span class='direct-chat-timestamp pull-right'><?php echo htmlspecialchars($row['date_sent']) ?></span>
				</div>
				<div class='direct-chat-text'>
					<?php echo htmlspecialchars($row['message'])?>
				</div>
				</div>
		
			<?php

			endforeach;
			echo "</div>";
			//echo "</ul>";
		


	}
	
}
else{
	echo $empty_message;
}
?>