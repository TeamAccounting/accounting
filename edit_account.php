<?php
	require_once('support/config.php');
	if(loggedId() && isset($_GET['id'])){
		addHead('Edit Account');
		addNavBar();
		addSideBar();
		$acc_id = $_GET['id'];
		$query = $connection->myQuery("SELECT * FROM accounts where acc_id = $acc_id ")->fetch(PDO::FETCH_ASSOC);
		$account_name = $query['account_name'];
		$atype = $query['type'];
		$query = $connection->myQuery("SELECT * FROM account_types where acc_types_id = $atype")->fetch(PDO::FETCH_ASSOC);
		$account_type = $query['name'];
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
		
?>

	<div class="content-wrapper">

	<div id="page-wrapper">
        <div class="col-md-8 col-md-offset-2" align='center'>
            <h3 style="color:#3c8dbc; font-weight:bold;">Edit an Account</h3>
				<?php
					Alert();
					unsetAlert();
				?>
           <br>
        </div>
        <div class='col-md-6 col-md-offset-3'> 
            <form class='form-horizontal' method='POST' enctype="multipart/form-data" action='php/editing_account.php'>
                <input type='hidden' name='id' value=<?php echo $acc_id?> >

						<div class='form-group' align='left'>
                            <label class='col-sm-3 control-label'>Account No.:</label>
                                <div class='col-md-8'>
                                    <input type="text" name="accno" class="form-control" value=<?php echo $acc_id;?> >
                                </div>
                        </div>

                        <div class='form-group' align='left'>
                            <label class='col-sm-3 control-label'>Account Name:</label>
                                <div class='col-md-8'>
                                    <input type="text" name="accname" class="form-control" value=<?php echo $account_name;?> >
                                </div>
                        </div>
								
						<div class='form-group' align='left'>
							<label class='col-sm-3 control-label'>Account Type:</label>
								<div class='col-md-8'>
									<select name='acctype' required class="form-control">
										<option><?php echo $account_type;?> </option>
										<option> </option>
										<option value="1">Revenue(Main) </option>
										<option value="2">Revenue(Side) </option>
										<option value="3">Expenses </option>
										<option value="4">Assets(Non-Current) </option>
										<option value="5">Assets(Current) </option>
										<option value="6">Liabilities(Current) </option>
										<option value="7">Liabilities(Non-Current) </option>
										<option value="8">Owner's Equity (Capital) </option>
										<option value="9">Owner's Equity (Drawing) </option>
										<option value="10">Contra (Current Assets) </option>
										<option value="11">Non-Current Asset </option>
									</select> 
								</div>
						</div>
		</div>

                        <div class='col-md-8 col-md-offset-2' align="center">
                        	<br>
                            <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                            <a href='chart_of_accounts.php' class='btn btn-danger'>Back</a>
                        </div>            
            </form>
    </div>
	</div>

<?php
	addFoot();
?>
