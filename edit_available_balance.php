<?php
	require_once('support/config.php');
	if(loggedId() && isset($_GET['id'])){
		addHead('Edit Available Balance');
		addNavBar();
		addSideBar();
		$balance_id = $_GET['id'];
		$query = $connection->myQuery("Select * From available_balance where id = $balance_id")->fetch(PDO::FETCH_ASSOC);
		$year = $query['year'];
		$amount = $query['amount'];
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
		
?>

	<div class="content-wrapper">

	<div id="page-wrapper">
        <div class="col-md-8 col-md-offset-2" align='center'>
            <h3 style="color:#3c8dbc; font-weight:bold;">Edit Available Balance</h3>
				<?php
					Alert();
					unsetAlert();
				?>
           <br>
        </div>

        <div class='col-md-6 col-md-offset-3'> 
            <form class='form-horizontal' method='POST' enctype="multipart/form-data" action='php/edit_balance.php'>
                <input type='hidden' name='id' value=<?php echo $balance_id?> >

					<div class='form-group' align='left'>
						<label class='col-sm-3 control-label'>Year: </label>
							<div class='col-md-8'>
								<div class="input-group date">
								<input type="text" name="year" class="form-control" value=<?php echo $year;?> readonly>
								</div>
							</div>
					</div>
                    <div class='form-group' align='left'>
                        <label class='col-sm-3 control-label'>Amount:</label>
                    		<div class='col-md-8'>
                                <input type="number" name="amount" class="form-control" value=<?php echo $amount;?>>
                            </div>
                    </div>

                    <div class='col-md-8 col-md-offset-2' align="center">
                       	<br>
                        <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                        <a href='available_balance.php' class='btn btn-danger'>Back</a>
                    </div>            
            </form>
        </div>

    </div>
	</div>
<?php
	addFoot();
?>
