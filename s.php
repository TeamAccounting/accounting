<?php
	$accounts = "cash";
	$ledger_array = array();
	//echo $ledger_array[$accounts][0][2];
	$newaccount="income";
	$ledger_array[$accounts][]= array("34","55","100");
	
	if(array_key_exists($newaccount, $ledger_array)){
		$ledger_array[$newaccount][] = array("2015","1300", "1");
	}else{
		
		$ledger_array[$newaccount] = array(array("2015","1300", "1")); 
	}
	echo $ledger_array[$newaccount][0][1];
	
	print_r($ledger_array);


	/*if(isset($_GET['to_date'])&&isset($_GET['from_date'])){
					if($fromdate<=$todate)
						$journalentries = $connection -> myQuery("Select journal_entry_no from journal_entries where journal_id between $fromdate and $todate");
					}else{
						$journalentries = $connection -> myQuery("Select journal_entry_no from journal_entries where journal_id between $todate and $fromdate");
					}
					$ledger_accounts = [];
					
					while($row=$journal_entries->fetch(PDO::FETCH_ASSOC)){
						$journal_entry_no = $row['journal_entry_no'];
						$journaldetails = $connection -> myQuery("Select * from journal_details INNER JOIN accounts on accounts.acc_id = journal_details.account_id where journal_entry_no =$journal_entry_no");
						$journal_date = $row['date_of_entry'];
						while($rows = $journaldetails->fetch(PDO::FETCH_ASSOC)){
							if(in_array($row[''])){
								
							}
						}
					}*/
?>