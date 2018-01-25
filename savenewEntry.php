<?php 
require_once('support/config.php');
	if(isset($_POST['entry_date']) && isset($_POST['entry_description'])){

$total = $_POST['crvalues'][0];

$user_id = $_SESSION[APPNAME]['UserId'];
// echo number_format($_POST['crvalues']);
		

// var_dump($_POST);

				$total_credit = array_sum($_POST['crvalues']);

// var_dump($insert['crvalues']);
// 		die;
				$journal_num = $_POST['JournalNumber'];

				$journalentry_id = $_POST['JournalID'];
				$entry_date = $_POST['entry_date'];
				$newDate = date("Y-m-d", strtotime($entry_date));
				$drnames=$_POST['drnames'];
				$drvalues=$_POST['drvalues'];
				if (!empty($_POST['drbank'])):
					$bankdr=$_POST['drbank'];
				else: $bankdr=null; endif;
				if (!empty($_POST['drchq'])):
					$chqdr=$_POST['drchq'];
				else: $chqdr=null; endif;
				if (!empty($_POST['crnames'])):
					$crnames=$_POST['crnames'];
				else: $crnames=null; endif;

				if (!empty($_POST['crbank'])):
					$bankcr=$_POST['crbank'];
				else: $bankcr=null; endif;	
				if (!empty($_POST['crchq'])):
					$chqcr=$_POST['crchq'];
				else: $chqcr=null; endif;	
				
				$crvalues=$_POST['crvalues'];


				$descdr=$_POST['drdesc'];
				$desccr=$_POST['crdesc'];

				
				$entry_desc=$_POST['entry_description'];
				
				
				
				
				$test=array();
				
				
				// $test($x)=$connection->lastInsertId();

				$cjay_id=null;
					for($x = 0; $x <= count($drnames)-1; $x++)
						{
							$insert_entry = $connection->myQuery("INSERT INTO `journal_details` (`account_id`, `journal_entry_no`, `amount`,`is_debit`,`desc`,`bank_name`,`chq_number`,`date_of_entry`,`request_by`) VALUES ((SELECT `acc_id` FROM accounts WHERE account_name ='$drnames[$x]'), $journalentry_id ,$drvalues[$x],1,'$descdr[$x]','$bankdr[$x]','$chqdr[$x]','$newDate','$user_id')");

							 
							// echo $test[$x]=$connection->lastInsertId();
						}
					
					for($x = 0; $x <= count($crnames)-1; $x++)
						{
							$insert_entry = $connection->myQuery("INSERT INTO `journal_details` (`account_id`, `journal_entry_no`, `amount`,`is_debit`,`desc`,`bank_name`,`chq_number`,`date_of_entry`,`request_by`) VALUES((SELECT `acc_id` FROM accounts WHERE account_name = '$crnames[$x]'), $journalentry_id ,$crvalues[$x],0,'$desccr[$x]','$bankcr[$x]','$chqcr[$x]','$newDate','$user_id')");

							  $test[$x]=$connection->lastInsertId();

							  // $cjay_id = $cjay_id.",".$test[$x]
						}
				
				// $fin_entry =  trim($insert_entry, ",").";";
				// $fin_entry;
				// $results = $connection -> myQuery($fin_entry);
				

				echo $cjay_id=implode(",", $test);
				
				if ($total > 10000) {



					$approver_id=$connection->myQuery("SELECT * from approval_flow ORDER BY id asc limit 1")->fetch(PDO::FETCH_ASSOC);
					

				} else {

					$approver_id=$connection->myQuery("SELECT * FROM finance_approver LIMIT 1")->fetch(PDO::FETCH_ASSOC);
					
				}

				$app_id = $approver_id['user_id'];
				$insert_journalentry = $connection->myQuery("INSERT INTO `cash_request` (`id`, `journal_entry_no`, `journal_id`, `date_of_entry`, `description`, `request_by`, `approver_id`, `total_amount`, `journal_details_id`) VALUES (NULL, '$journalentry_id', '$journal_num','$newDate','$entry_desc','$user_id','$app_id','$total_credit','$cjay_id')");
				
						// var_dump($insert_entry);
				

	
				redirect("journal_entry.php?id=$journal_num");	

				
	
	}else{
				redirect('../index.php');
			}
?>