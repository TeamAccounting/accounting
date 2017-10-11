<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Income Statement');
		addNavBar();
		addSideBar();
		if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
			if($_POST['from_date']<=$_POST['to_date']){
				$fromdate = $_POST['from_date'];
				$todate = $_POST['to_date'];
			}else{
				$fromdate = $_POST['to_date'];
				$todate = $_POST['from_date'];
			}
		}
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
?>

<div class="content-wrapper fixed">

	<section class="content-header">
	<h2> Income Statement</h2>
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
				<form action='income_statement.php' method='POST'>
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
					<button type='submit' class='btn btn-success'>Make Income Statement</button>
					<a href='php/print_income.php'><button type='button' class='btn btn-success' >Print</button></a>
				</div>
		</form>
		</div>
		
	<div class="box-body">
	
		
		<?php
			if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
		?>
					<div class='form-group col-lg-3 col-md-3' >
					<input type='text' class='form-control' name='title' align='center' placeholder='Enter Title'></input>
					<input type='text' class='form-control' name='title' align='center' placeholder='Description'></input>
			</div>
		<?php
			}
		?>
		<table id="table" class="table responsive-table table-bordered table-striped">
			<thead>
				<tr class="tableheader">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
				<?php
			if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
				?>
				
				<tr>
					<td><b>REVENUE</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$query = $connection -> myQuery("Select account_name, Sum(amount) as total, date_of_entry From journal_details 
													INNER JOIN accounts on accounts.acc_id = journal_details.account_id
													INNER JOIN journal_entries on journal_entries.journal_entry_no = journal_details.journal_entry_no
													Where (journal_entries.journal_id between $fromdate and $todate) AND (type = 1 OR type = 2) AND (is_debit = 0) 
													group by accounts.account_name"); // QUERY FOR REVENUE
				$total = 0;
				while($row=$query->fetch(PDO::FETCH_ASSOC)){
					$total = $total + $row['total'];
			?>
				<tr>
					<td><p style='text-indent:10vh;'><?php echo $row['account_name'];?></td>
					<td><?php echo number_format( $row['total']);?></td>
					<td></td>
					<td></td>
				</tr>
			<?php
				}
			?>
				<tr>
					<td><p style='text-indent:10vh;'><b>TOTAL REVENUE</b></td>
					<td></td>
					<td><?php echo number_format( $total);?></td>
					<td></td>
				</tr>
			
				
			<tr>
					<td><b>EXPENSES</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
			if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
				$query = $connection -> myQuery("Select account_name, Sum(amount) as total, date_of_entry From journal_details 
													INNER JOIN accounts on accounts.acc_id = journal_details.account_id
													INNER JOIN journal_entries on journal_entries.journal_entry_no = journal_details.journal_entry_no
													Where (journal_entries.journal_id between $fromdate and $todate) AND (type = 3) AND (is_debit = 1) 
													group by accounts.account_name"); // QUERY FOR EXPENSES
				$totalExpense = 0;
				while($row=$query->fetch(PDO::FETCH_ASSOC)){
					$totalExpense = $totalExpense + $row['total'];
			?>
				<tr>
					<td><p style='text-indent:10vh;'><?php echo $row['account_name'];?></td>
					<td><?php echo number_format($row['total']);?></td>
					<td></td>
					<td></td>
				</tr>
			<?php
				}
			?>
				<tr>
					<td><p style='text-indent:10vh;'><b>TOTAL EXPENSES</b></td>
					<td></td>
					<td><?php echo number_format( $totalExpense);?></td>
					<td></td>
				</tr>
			<?php	
			}
			?>
			
			<tr>
				<td><b>NET INCOME</b></td>
				<td></td>
				<td></td>
				<td><?php echo $total - $totalExpense;?></td>
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


