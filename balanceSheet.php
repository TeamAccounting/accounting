<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Balance Sheet');
		addNavBar();
		addSideBar();
		if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
			if($_POST['fromDate']<=$_POST['toDate']){
				$from_Date = $_POST['fromDate'];
				$to_Date = $_POST['toDate'];
			}else{
				$from_Date = $_POST['toDate'];
				$to_Date = $_POST['fromDate'];
			}
		}
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>

<div class="content-wrapper fixed">

<section class="content-header">
	<h1>Balance Sheet</h1> 
	<?php
		Alert();
		unsetAlert();
			$journalsTable=$connection->myQuery("SELECT * FROM journals WHERE is_archived != 1");
				if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
					$fromDate = $connection->myQuery("SELECT journal_date FROM journals WHERE journal_id = $from_Date")->fetch(PDO::FETCH_ASSOC);
					$toDate = $connection->myQuery("SELECT journal_date FROM journals WHERE journal_id = $to_Date")->fetch(PDO::FETCH_ASSOC);
						echo "<h3><center><b>".date("F d Y",strtotime($fromDate['journal_date']))."</b> to <b>". date("F d Y",strtotime($toDate['journal_date'])) ."</b</center></h3>";
				} 
	?>
<form action="balanceSheet.php" method="POST">
	<div class="row">

                  <label class="col-xs-1 control-label" for="fromdate">From:</label>
				  <div class= "col-xs-2">
					<select class="form-control" name="fromDate" id="fromdate">
						<option disabled selected>Date</option>
						<?php 
						while($row=$journalsTable->fetch(PDO::FETCH_ASSOC)){
									?>
						<option value=<?php echo $row['journal_id'];?>><?php echo htmlspecialchars($row['journal_date']); ?></option>
						<?php } ?>
					</select>
					</div>
		 

                 <label class="col-xs-1 control-label" for="todate">To:</label>
				 <div class= "col-xs-2">
					<select class="form-control" name="toDate" id="todate">
						<option disabled selected>Date</option>
							<?php 
							$journalsTable=$connection->myQuery("SELECT * FROM journals WHERE is_archived != 1");
							while($row=$journalsTable->fetch(PDO::FETCH_ASSOC)){
									?>
						<option value=<?php echo $row['journal_id'];?>><?php echo htmlspecialchars($row['journal_date']); ?></option>
							<?php } ?>
                  </select>
				</div>
				

			<button type="submit" class="btn bg-olive">Generate</button>
			<button type="button" class="btn btn-success">Print</button>
		 
		 
	</div>
</form>				 
</section>





<section class ="content">
	<div class="row">
	<div class= "col-md-6">
		<div class="box box-primary">
			<table class="table">
			<thead >
				<tr>
					<th>Assets</th>
					<th class="text-right"><b>Amount</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
						$query_asset = $connection -> myQuery("SELECT account_name, SUM(CASE is_debit WHEN 1 THEN amount WHEN 0 THEN -amount END) AS aTotal 
																		FROM journal_details 
																		INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																		INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																		WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																		AND (type = 4 OR type = 5)
																		GROUP BY accounts.account_name");
					$totalAssets = 0;													
						while($row_asset=$query_asset->fetch(PDO::FETCH_ASSOC)){
								$totalAssets = $totalAssets + $row_asset['aTotal'];
					?>
					<tr>
						<td><p style='text-indent:5vh;'><?php echo $row_asset['account_name'];?></td>
						<td><?php echo number_format($row_asset['aTotal'],2); }?></td>
					</tr>

					<tr>
						<td><b>Total Assets</b></td>
					<td class="text-right"><b><?php echo number_format($totalAssets,2); }?></b></td>
					</tr>
		</tbody>


	</table>
	
	</div>
</div>



	<div class= "col-md-6">
		<div class="box box-primary">
			<table class="table">
				<thead >
					<tr>
						<th><b>Liabilities and Equity</b></th>
						<th class="text-right"><b>Amount</b></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
						$query_liabilities = $connection -> myQuery("SELECT account_name, SUM(CASE is_debit WHEN 0 THEN amount WHEN 1 THEN -amount END) AS LTotal 
																		FROM journal_details 
																		INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																		INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																		WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																		AND (type = 6 OR type = 7)
																		GROUP BY accounts.account_name");
					$totalLiabilities = 0;
						while($row_liabilities=$query_liabilities->fetch(PDO::FETCH_ASSOC)){
							$totalLiabilities = $totalLiabilities + $row_liabilities['LTotal'];
					?>
					<tr>
						<td><b>Liabilities</b></td>
						<td></td>
					</tr>
					
					<tr>
						<td><p style='text-indent:5vh;'><?php echo $row_liabilities['account_name'];?></td>
						<td><?php echo number_format($row_liabilities['LTotal'],2); }?></td>
					</tr>
					
		
						
					<tr>
						<td><b>Total Liabilities</b></td>
					<td class="text-right"><?php echo number_format($totalLiabilities,2); ?></td>
					</tr>
			

				
				
				
				<!-- EQUITY COMPUTANTION -->			
					<tr>
						<td><b>Equity</b></td>
						<td></td>
					</tr>
					
				<?php
					if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
						$query_capital = $connection -> myQuery("SELECT account_name, SUM(amount) AS CTotal 
																								FROM journal_details 
																								INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																								INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																								WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																								AND (type = 8) AND (is_debit = 0) 
																								GROUP BY accounts.account_name");
					$totalCapital = 0;
						while($row_capital =$query_capital->fetch(PDO::FETCH_ASSOC)){
							$totalCapital = $totalCapital + $row_capital['CTotal'];
						}
					?>
					
					<tr>
						<td><p style='text-indent:5vh;'><?php echo $row['account_name']; ?></td>
						<td><?php echo number_format($totalCapital,2); ?></td>
					</tr>
						<?php
							}
						?>	

				<?php
					if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
						$query_a = $connection -> myQuery("SELECT account_name, SUM(amount) AS RTotal 
																		FROM journal_details 
																		INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																		INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																		WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																		AND (type = 1 OR type = 2) AND (is_debit = 0) 
																		GROUP BY accounts.account_name");
																		
						$query_b = $connection -> myQuery("SELECT account_name, SUM(amount) AS ETotal 
																		FROM journal_details 
																		INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																		INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																		WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																		AND (type = 3) AND (is_debit = 1) 
																		GROUP BY accounts.account_name");
																																				
																		
					$totalRevenue = 0;
					$totalExpense= 0;
					$totalIncome = 0;
					
						while($row_a =$query_a->fetch(PDO::FETCH_ASSOC)){
							$totalRevenue = $totalRevenue + $row_a['RTotal'];
								}
						while($row_b = $query_b->fetch(PDO::FETCH_ASSOC)){
							$totalExpense = $totalExpense + $row_b['ETotal'];
						}
					//TOTAL INCOME COMPUTATION
									$totalIncome = $totalRevenue - $totalExpense;
					?>
					
					
					
					
					<tr>
						<td><p style='text-indent:5vh;'>Earnings</td>
						<td><?php echo number_format($totalIncome,2); ?></td>
					</tr>
					<!-- TOTAL DRAWING COMPUTATION -->
					<?php
					if(isset($_POST['fromDate'])&&isset($_POST['toDate'])){
						$query = $connection -> myQuery("SELECT account_name, SUM(amount) AS DTotal 
																		FROM journal_details 
																		INNER JOIN accounts ON accounts.acc_id = journal_details.account_id 
																		INNER JOIN journal_entries ON journal_entries.journal_entry_no = journal_details.journal_entry_no 
																		WHERE (journal_entries.journal_id BETWEEN $from_Date AND $to_Date) 
																		AND (type = 9) AND (is_debit = 1) 
																		GROUP BY accounts.account_name");
																		
					$totalDrawing = 0;
					$totalEquity = 0;
					$totalLiabilitiesEquity = 0;
					
						while($row=$query->fetch(PDO::FETCH_ASSOC)){
							$totalDrawing = $totalDrawing + $row['DTotal'];
						}
						
						
						//TOTAL EQUITY LIABILITY COMPUTATION
						$totalEquity = $totalCapital + $totalIncome - $totalDrawing;
						$totalLiabilitiesEquity = $totalLiabilities + $totalEquity;
					?>
					
					<tr>
						<td><p style='text-indent:10vh;'>Drawing</td>
					<td>(<?php echo number_format($totalDrawing,2);} ?>)</td>
					</tr>
					
					<tr>
						<td><b>Total Equity</b></td>
						<td class="text-right"><?php echo number_format($totalEquity,2); ?></td>
					</tr>
					
					<tr>
						<td><b>Total Liabilities and Equity</b></td>
					<td class="text-right"><b><?php echo number_format($totalLiabilitiesEquity,2); }?> </b></td>
					</tr>

					<?php
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