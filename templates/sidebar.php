<div class="main-sidebar ">
  <!-- Inner sidebar -->
  <div class="sidebar " >
  
  <ul class="sidebar-menu " >
      <li class="header">Accounting Tools</li>

      <!-- Optionally, you can add icons to the links -->
		<li class="treeview">
				<a href="dash.php">
				<i class="fa fa-dashboard"></i> 
				<span>Dashboard</span>
			</a>
		</li>
		<li class="treeview">
				<a href="#">
				<i class="glyphicon glyphicon-list-alt"></i> 
				<span>General Journal</span>
				</a>
			<ul class="treeview-menu menu-open">
					<li><a href="general_journal.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						<span>View General Journal</span>
						</a>
					</li>
					<li><a href="archived_journals.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						<span>Archived Journals</span>
						</a>
					</li>
					
			</ul>
		</li>
		
		
		<li class="treeview">
			<a href="#">
				<i class="glyphicon glyphicon-book"></i> 
				<span>Ledger</span>
			</a>
			<ul class="treeview-menu menu-open">
					<li><a href="general_ledger.php">
						<i class="fa fa-file-text"></i>
						<span>General Ledger</span>
						</a>
					</li>
					<li><a href="trial_balance.php">
						<i class="fa fa-file-text"></i>
						<span>Trial Balance</span>
						</a>
					</li>
					
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="glyphicon glyphicon-stats"></i>
				<span>Financial Statement</span>
			</a>
			<ul class="treeview-menu menu-open">
					<li><a href="balanceSheet.php">
						<i class="fa fa-bar-chart"></i>
						<span>Balance Sheet</span>
						</a>
					</li>
					<li><a href="income_statement.php">
						<i class="fa fa-bar-chart"></i>
						<span>Income Statement</span>
						</a>
					</li>
					<li><a href="#">
						<i class="fa fa-bar-chart"></i>
						<span>Cash Flow</span>
						</a>
					</li>
			</ul>
		</li>
		<?php 

		
		$user = $_SESSION[APPNAME]['UserId'];
		$pending=$connection->myQuery("SELECT COUNT(*) AS total FROM cash_request cr WHERE request_by = ".$user)->fetch(PDO::FETCH_ASSOC);
		$approval=$connection->myQuery("SELECT COUNT(*) As total FROM cash_request cr WHERE status_id='1' AND approver_id = ".$user)->fetch(PDO::FETCH_ASSOC);

		
		
		

			if ($pending['total'] > 0):
		?>
		<li class="header">Pending Request</li>
		<li class="treeview">
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
		<li class="treeview">
				<a href="approval_flow.php">
				<i class="fa fa-users"></i> 
				<span>Approval Flow</span>
			</a>
		</li>




	  
			<li class='treeview'>
				<a href='#'>
					<i class='fa fa-gear'></i>
					<span>Settings</span>
				</a>
					<ul class='treeview-menu menu-open'>

					<?php if($_SESSION[APPNAME]['UserType'] == 1): ?>

						<li><a href='users.php'>
							<i class='fa fa-users'></i>
							<span>Users</span>
							</a>
						</li>
					<?php endif; ?>
							<li><a href='chart_of_accounts.php'>
							<i class='fa fa-folder'></i>
							<span>Chart of Accounts</span>
							</a>
						</li>
						
						<li><a href='archived_accounts.php'>
							<i class='fa fa-folder'></i>
							<span>Archived Accounts</span>
							</a>
						</li>
						<?php if($_SESSION[APPNAME]['UserType'] == 1): ?>
						<li><a onclick='databaseModal();' role='button'>
							<i class='fa fa-database'></i>
							<span>Backup Restore</span>
							</a>
						</li>
						<?php endif; ?>
						<li><a href='audit_log.php'>
							<i class='fa fa-folder-o'></i>
							<span>Audit Trail</span>
							</a>
						</li>
					</ul>
				</li>	
			
		
	</ul><!-- /.sidebar-menu -->
  </div>
</div><!-- /.main-sidebar -->

