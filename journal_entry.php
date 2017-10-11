<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Dashboard');
		addNavBar();
		addSideBar();
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
?>


<div class="content-wrapper">

	<div class="box">
		<div class="box-body">
				<input type="text" class="container-fluid" size="30" name="search" placeholder="Search">
				<button type="submit" class="btn btn-primary" id="btn-search" name="btnsearch"><i class="fa fa-search"></i> </button>
				<button type="submit" class="btn btn-primary pull-right" id="btn-add" onclick='createEntry()' name="btnadd"><i class="fa fa-plus"> Add Journal Entry</i></button>
		</div>
	<div class="box-body">

		<table id="table" class="table responsive-table table-bordered table-striped">
			<thead>
				<tr class="tableheader">
					<th>JE No.</th>
					<th>DATE OF ENTRY</th>
					<th>ACCOUNT TITLE</th>
					<th>DEBIT</th>
					<th>CREDIT</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$journal_no = $_GET['id'];
					$entriestable = $connection -> myQuery("SELECT 
							journal_entries.journal_entry_no,
							date_of_entry,
							description
						FROM journal_entries
						INNER JOIN journal_details on journal_entries.journal_entry_no = journal_details.journal_entry_no  
						where journal_entries.journal_id=$journal_no 
						GROUP by journal_entries.journal_entry_no");
						
					$entrydetailtable=$connection -> myQuery("SELECT
					journal_entries.journal_entry_no,
					journal_entries.date_of_entry,
					journal_details.account_id,
                    accounts.account_name,
					journal_details.amount,
					journal_details.is_debit
					
						FROM journal_entries
						INNER JOIN journal_details on journal_entries.journal_entry_no = journal_details.journal_entry_no
                        INNER JOIN accounts on accounts.acc_id = journal_details.account_id						
						where journal_entries.journal_id=$journal_no ");
	
					while($rows = $entriestable->fetch(PDO::FETCH_ASSOC)){
						$entryno = $rows['journal_entry_no'];
						$countentryspan = $connection -> myQuery("SELECT COUNT(journal_details.journal_entry_no) as count 
																FROM journal_details where 
																journal_details.journal_entry_no=$entryno")->fetch(PDO::FETCH_ASSOC);
						$rowspan = $countentryspan['count']+1;
				?>
				<tr>
					<td rowspan='<?php echo $rowspan;?>' style="border-bottom:1pt solid black;" ><?php echo htmlspecialchars(substr_replace($entryno,'-',4,0));?></td>
					<td rowspan='<?php echo $rowspan;?>' style="border-bottom:1pt solid black;" ><?php echo htmlspecialchars($rows['date_of_entry']);?></td>
				<?php
					for($count=1;$count<= $rowspan-1;$count++){
						$row=$entrydetailtable->fetch(PDO::FETCH_ASSOC);
						$isDebit=$row['is_debit'];
						if($count==1){
				?>
					<td><?php
						if($isDebit==0){
							echo "<p style='text-indent:10vh;'>".htmlspecialchars($row['account_name'])."</p>";
						}else{
							echo htmlspecialchars($row['account_name']);
						}
						?>
					</td>
					<td><?php if($isDebit==1){echo htmlspecialchars($row['amount']);}?></td>
					<td><?php if($isDebit==0){echo htmlspecialchars($row['amount']);}?></td>
					</tr>
				<?php
						}else{
							
						
				?>
				<tr>
					<td>
						<?php
						if($isDebit==0){
							echo "<p style='text-indent:10vh;'>".htmlspecialchars($row['account_name'])."</p>";
						}else{
							echo htmlspecialchars($row['account_name']);
						}
						?>	
					</td>
					<td><?php if($isDebit==1){echo htmlspecialchars($row['amount']);}?></td>
					<td><?php if($isDebit==0){echo htmlspecialchars($row['amount']);}?></td>
				</tr>
				<?php
							
						}
						
					}
					
				?>
				<tr>
					<td style="border-bottom:1pt solid black;" ><?php echo '*'.htmlspecialchars($rows['description']);?></td>
					<td style="border-bottom:1pt solid black;" ></td>
					<td style="border-bottom:1pt solid black;" ></td>
				</tr>
				
					<?php
				}
			
				?>
				
				
			</tbody>
		</table>
		</div>
	</div>
</div>

<!-- add content here-->


	
<?php
		include_once("modals/create_entry.php");
	?>





<?php
	addFoot();
?>
