<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('General Ledger');
		addNavBar();
		addSideBar();
		if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
			$fromdate = $_POST['from_date'];
			$todate = $_POST['to_date'];
		}
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>

<div class="content-wrapper">
	
<section class="content-header">
	<h2> General Ledger</h2>
	<?php
		Alert();
		unsetAlert();
		$journalstable=$connection->myQuery("Select * From journals where is_archived != 1");
		if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
			$from_date = $connection->myQuery("Select journal_date From journals where journal_id = $fromdate")->fetch(PDO::FETCH_ASSOC);
			$to_date = $connection->myQuery("Select journal_date From journals where journal_id = $todate")->fetch(PDO::FETCH_ASSOC);
			echo "<h3 align='center'><strong>".date("F d Y",strtotime($from_date['journal_date']))."</strong> to <strong>". date("F d Y",strtotime($to_date['journal_date'])) ."</strong></h3>";
		}
	?>
	<div class="box">
		<div class="box-body">
				</button> <br/>  <br/>
				<form action='general_ledger.php' method='POST'>
				<div class="form-group">
					<label class="col-lg-2 control-label" for='fromdate'>From the Date of</label>
					<div class="col-lg-2">
						<select class='form-control' name="from_date" id="fromdate" required>
							<option disabled selected value="">-</option>
							<?php 
								while($row=$journalstable->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value=<?php echo $row['journal_id'];?>><?php echo htmlspecialchars($row['journal_date']);?></option>
									<?php
								}
								
							?>
						</select>
					</div>
					<label class="col-lg-1 control-label" for='todate'>To</label>
					<div class="col-lg-2">
						<select class='form-control' name="to_date" id="todate" required>
							<option disabled selected value="">-</option>
							<?php 
								$journalstable=$connection->myQuery("Select * From journals where is_archived != 1");
								while($row=$journalstable->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value=<?php echo $row['journal_id'];?>><?php echo htmlspecialchars($row['journal_date']);?></option>
									<?php
								}
								
							?>
						</select>
					</div>
					<button type='submit' class='btn btn-success'>Make Ledger</button>
				</div>
		</form>
		</div>
	<div class="box-body">
		<table id="table" class="table responsive-table table-bordered table-striped">
			<thead>
				<tr class="tableheader">
					<th>ACCOUNT</th>
					<th>DATE OF ENTRY</th>
					<th>DEBIT</th>
					<th>CREDIT</th>
					<th>BALANCE</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr class="tableheader"> -->
				<?php
					$ledger_array = array();
				
					if(isset($_POST['to_date'])&&isset($_POST['from_date'])){
						
						if($fromdate<=$todate){
							
							$journalentries = $connection -> myQuery("Select journal_entry_no, date_of_entry from journal_entries where journal_id between $fromdate and $todate");
						}else{
							$journalentries = $connection -> myQuery("Select journal_entry_no, date_of_entry from journal_entries where journal_id between $todate and $fromdate");
						}
					
					
						while($row=$journalentries->fetch(PDO::FETCH_ASSOC)){
							$journal_entry_no = $row['journal_entry_no'];
							$journal_date = $row['date_of_entry'];
							$journaldetails = $connection -> myQuery("Select * from journal_details INNER JOIN accounts on accounts.acc_id = journal_details.account_id
INNER JOIN account_types on accounts.type = account_types.acc_types_id where journal_entry_no = $journal_entry_no");
						
							while($rows = $journaldetails->fetch(PDO::FETCH_ASSOC)){
								$newaccount = $rows['account_name'];
								if(array_key_exists($newaccount, $ledger_array)){
									if($rows['is_debit']==1){
										$previous = count($ledger_array[$newaccount])-1;
										if($rows['is_debit']==$rows['inc_when_debit']){
											$ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$ledger_array[$newaccount][$previous][4] + $rows['amount']);
										}else{
											$ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$ledger_array[$newaccount][$previous][4] - $rows['amount']);
										}
									}else{
										$previous = count($ledger_array[$newaccount])-1;
										if($rows['is_debit']==$rows['inc_when_debit']){
											$ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],$ledger_array[$newaccount][$previous][4] + $rows['amount']);
										}else{
											$ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],$ledger_array[$newaccount][$previous][4] - $rows['amount']);
										}
									}
								}else{
									
									if($rows['is_debit']==1){
										if($rows['is_debit']==$rows['inc_when_debit']){
											$ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],+$rows['amount']);
										}else{
											$ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],-$rows['amount']);
										}
									}else{
										if($rows['is_debit']==$rows['inc_when_debit']){
											$ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],+$rows['amount']);
										}else{
											$ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],-$rows['amount']);
										}
									}
								
								}
							}
						}
						foreach($ledger_array as $account_title => $content){
							$row = 0;
							for($row = 0; $row<=count($content)-1;$row++){
								if($row==0){
									echo "<tr >";
									echo "<td style='border-top:thin solid;'>".$account_title."</td>";
									echo "<td style='border-top:1pt solid black;'>".$content[$row][0]."</td>";
									echo "<td style='border-top:1pt solid black;'>".$content[$row][1]."</td>";
									echo "<td style='border-top:1pt solid black;'>".$content[$row][2]."</td>";	
									echo "<td style='border-top:1pt solid black;'>".$content[$row][4]."</td>";	
									echo "</tr>";
								}else{
									echo "<tr>";
									echo "<td></td>";
									echo "<td>".$content[$row][0]."</td>";
									echo "<td>".$content[$row][1]."</td>";
									echo "<td>".$content[$row][2]."</td>";	
									echo "<td style='border-top:1pt solid black;'>".$content[$row][4]."</td>";	
									echo "</tr>";
								}
							}
							
							echo "<tr>";
							echo "<td style='border-bottom:1pt solid black;'></td>";
							echo "<td style='border-bottom:1pt solid black;'></td>";
							echo "<td style='border-bottom:1pt solid black;'></td>";
							echo "<td style='border-bottom:1pt solid black;'><strong> TOTAL: </strong></td>";	
							echo "<td style='border-bottom:1pt solid black;'><strong>".$content[$row-1][4]."</strong></td>";	
							echo "</tr>";
							
						}
						
						
					}
				?>
				

					
			</tbody>
		</table>
	</div>
	</div>
	</div>
</section>

 
</div>





<?php
	addFoot();
?>
