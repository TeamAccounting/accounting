<?php

	$page1=ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));


	$setting_page="Users,Budget_per_week,Department,Chart_of_accounts,Archived_accounts,Audit_log,Available_balance,Myaccount";
	
	$allowed_page=explode(",", $setting_page);
	if(array_search($page1,$allowed_page) !==false) {
		// echo "<script>alert('".."');</script>";
		$settings = "Active";
	} else {
		$settings = "";
	}
	$journal_page="General_journal,Archived_journals";
	
	$allowed_page=explode(",", $journal_page);
	if(array_search($page1,$allowed_page) !==false) {
		// echo "<script>alert('".."');</script>";
		$journal = "Active";
	} else {
		$journal = "";
	}

	$ledger_page="General_ledger,Trial_balance,Additional_cash";
	
	$allowed_page=explode(",", $ledger_page);
	if(array_search($page1,$allowed_page) !==false) {
		// echo "<script>alert('".."');</script>";
		$ledger = "Active";
	} else {
		$ledger = "";
	}

	$financial_page="BalanceSheet,Income_statement";
	
	$allowed_page=explode(",", $financial_page);
	if(array_search($page1,$allowed_page) !==false) {
		// echo "<script>alert('".."');</script>";
		$financial = "Active";
	} else {
		$financial = "";
	}


?>

<div class="main-sidebar ">
  <!-- Inner sidebar -->
  <div class="sidebar " >
  
  <ul class="sidebar-menu " >
      <li class="header">Accounting Tools</li>

      <!-- Optionally, you can add icons to the links -->
		<li class="treeview <?php if($page1=='Dash'){echo 'Active';} ?>">
				<a href="dash.php">
				<i class="fa fa-dashboard"></i> 
				<span>Dashboard</span>
			</a>
		</li>
		<li class="treeview <?php echo $journal; ?>">
				<a href="#">
				<i class="glyphicon glyphicon-list-alt"></i> 
				<span>General Journal</span>
				</a>
			<ul class="treeview-menu menu-open">
					<li class="<?php if($page1=='General_journal'){echo 'Active';} ?>"><a href="general_journal.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						<span>View General Journal</span>
						</a>
					</li>
					<?php if($_SESSION[APPNAME]['UserType'] !=4): ?>
						<li class="<?php if($page1=='Archived_journals'){echo 'Active';} ?>"><a href="archived_journals.php">
							<i class="glyphicon glyphicon-list-alt"></i>
							<span>Archived Journals</span>
							</a>
						</li>
					<?php endif; ?>
					
			</ul>
		</li>
		<?php if($_SESSION[APPNAME]['UserType'] != 4): ?>
		
			<li class="treeview <?php echo $ledger; ?>">
				<a href="#">
					<i class="glyphicon glyphicon-book"></i> 
					<span>Ledger</span>
				</a>
				<ul class="treeview-menu menu-open">
						<li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="general_ledger.php">
							<i class="fa fa-file-text"></i>
							<span>General Ledger</span>
							</a>
						</li>
						<li class="<?php if($page1=='Trial_balance'){echo 'Active';} ?>"><a href="trial_balance.php">
							<i class="fa fa-file-text"></i>
							<span>Trial Balance</span>
							</a>
						</li>
						<li class="<?php if($page1=='Additional_cash'){echo 'Active';} ?>"><a href="additional_cash.php">
							<i class="fa fa-file-text"></i>
							<span>Additional Cash</span>
							</a>
						</li>
						
				</ul>
			</li>
		<?php endif; ?>
		<?php if($_SESSION[APPNAME]['UserType'] != 4): ?>
			<li class="treeview <?php echo $financial; ?>">
				<a href="#">
					<i class="glyphicon glyphicon-stats"></i>
					<span>Financial Statement</span>
				</a>
				<ul class="treeview-menu menu-open">
						<li class="<?php if($page1=='BalanceSheet'){echo 'Active';} ?>"><a href="balanceSheet.php">
							<i class="fa fa-bar-chart"></i>
							<span>Balance Sheet</span>
							</a>
						</li>
						<li class="<?php if($page1=='Income_statement'){echo 'Active';} ?>"><a href="income_statement.php">
							<i class="fa fa-bar-chart"></i>
							<span>Income Statement</span>
							</a>
						</li>
						<!-- <li><a href="#">
							<i class="fa fa-bar-chart"></i>
							<span>Cash Flow</span>
							</a>
						</li> -->
				</ul>
			</li>
		<?php endif; ?>
		<?php 

		
		$user = $_SESSION[APPNAME]['UserId'];
		$pending=$connection->myQuery("SELECT COUNT(*) AS total FROM cash_request cr WHERE request_by = ".$user)->fetch(PDO::FETCH_ASSOC);
		$approval=$connection->myQuery("SELECT COUNT(*) As total FROM cash_request cr WHERE status_id='1' AND approver_id = ".$user)->fetch(PDO::FETCH_ASSOC);

		
		
		

			if ($pending['total'] > 0):
		?>
		<li class="header">Pending Request</li>
		<li class="treeview <?php if($page1=='Pending_request'){echo 'Active';} ?>">
				<a href="pending_request.php">
				<i class="fa fa-file-text"></i>
				<span>Cash Request<small class='label pull-right bg-primary'><?php echo $pending['total']; ?></small></span>
			</a>
		</li>
		<?php 
			endif;
			if ($approval['total'] > 0):
		?>
		<li class="header">For Approval</li>
		<li class="treeview">
				<a href="cash_approval.php">
				<i class="fa fa-file-text"></i>
				<span>Cash Approval<small class='label pull-right bg-primary'><?php echo $approval['total']; ?></small></span>
			</a>
		</li>
		<?php 
			endif;
		?>

		<li class="header">Administrator</li>
		<?php if($_SESSION[APPNAME]['UserType'] == 1): ?>
			<li class="treeview">
					<a href="approval_flow.php">
					<i class="fa fa-users"></i> 
					<span>Approval Flow</span>
				</a>
			</li>
		<?php endif; ?>




	  
			<li class='treeview <?php echo $settings; ?>'>
				<a href='#'>
					<i class='fa fa-gear'></i>
					<span>Settings</span>
				</a>
					<ul class='treeview-menu menu-open'>
					<!-- user -->
					<?php if($_SESSION[APPNAME]['UserType'] == 1): ?>

						<li class="<?php if($page1=='Users'){echo 'Active';} ?>"><a href='users.php'>
							<i class='fa fa-users'></i>
							<span>Users</span>
							</a>
						</li>
					<?php endif; ?>

					<!-- budget per week -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>

						<li class="<?php if($page1=='Budget_per_week'){echo 'Active';} ?>"><a href='budget_per_week.php'>
							<i class='fa fa-folder'></i>
							<span>Budget Per Week</span>
							</a>
						</li>
					<?php endif; ?>

					<!-- department -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>
						<li class="<?php if($page1=='Department'){echo 'Active';} ?>"><a href='department.php'>
							<i class='fa fa-users'></i>
							<span>Department</span>
							</a>
						</li>
					<?php endif; ?>

					<!-- chart of accounts -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>
							<li class="<?php if($page1=='Chart_of_accounts'){echo 'Active';} ?>"><a href='chart_of_accounts.php'>
							<i class='fa fa-folder'></i>
							<span>Chart of Accounts</span>
							</a>
							</li>
					<?php endif; ?>
					<!-- archived accounts -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>
						<li class="<?php if($page1=='Archived_accounts'){echo 'Active';} ?>"><a href='archived_accounts.php'>
							<i class='fa fa-folder'></i>
							<span>Archived Accounts</span>
							</a>
						</li>
					<?php endif; ?>

					<!-- backup restore -->
					<?php if($_SESSION[APPNAME]['UserType'] == 1): ?>
<!-- 						<li><a onclick='databaseModal();' role='button'>
							<i class='fa fa-database'></i>
							<span>Backup Restore</span>
							</a>
						</li> -->
					<?php endif; ?>
					<!-- audit trail -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>
						<li class="<?php if($page1=='Audit_log'){echo 'Active';} ?>"><a href='audit_log.php'>
							<i class='fa fa-folder-o'></i>
							<span>Audit Trail</span>
							</a>
						</li>
					<?php endif; ?>

					<!-- available balance -->
					<?php if($_SESSION[APPNAME]['UserType'] <> 4): ?>
						<li class="<?php if($page1=='Available_balance'){echo 'Active';} ?>"><a href='available_balance.php'>
							<i class='fa fa-folder-o'></i>
							<span>Available Balance</span>
							</a>
						</li>
					<?php endif; ?>


						<li class="<?php if($page1=='Myaccount'){echo 'Active';} ?>"><a href='myaccount.php'>
							<i class='fa fa-folder-o'></i>
							<span>My Account</span>
							</a>
						</li>
					</ul>
				</li>	
			
		
	</ul><!-- /.sidebar-menu -->
  </div>
</div><!-- /.main-sidebar -->

