<?php
	require_once('support/config.php');
	if(loggedId() && isset($_GET['id'])){
		addHead('Edit Journal');
		addNavBar();
		addSideBar();
		$journal_id = $_GET['id'];
		$query = $connection->myQuery("Select * From journals where journal_id = $journal_id")->fetch(PDO::FETCH_ASSOC);
		$description = $query['description'];
		$journal_date = $query['journal_date'];
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
		
?>

	<div class="content-wrapper">

	<div id="page-wrapper">
        <div class="col-md-8 col-md-offset-2" align='center'>
            <h3 style="color:#3c8dbc; font-weight:bold;">Edit General Journal</h3>
				<?php
					Alert();
					unsetAlert();
				?>
           <br>
        </div>

        <div class='col-md-6 col-md-offset-3'> 
            <form class='form-horizontal' method='POST' enctype="multipart/form-data" action='php/edit_journal.php'>
                <input type='hidden' name='id' value=<?php echo $journal_id?> >

					<div class='form-group' align='left'>
						<label class='col-sm-3 control-label'>Date: </label>
							<div class='col-md-8'>
								<div class="input-group date" data-provide="datepicker">
								<input type="text" placeholder="mm/dd/yyyy" name="date" class="form-control" style="position: relative; z-index: 100000;" require value=<?php echo $journal_date;?> >
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</div>			
								</div>
							</div>
					</div>
                    <div class='form-group' align='left'>
                        <label class='col-sm-3 control-label'>Description</label>
                    		<div class='col-md-8'>
                                <textarea name='desc' required maxlength="100" placeholder="" class='form-control' style='resize: none' rows='4'><?php echo $description;?></textarea>
                            </div>
                    </div>

                    <div class='col-md-8 col-md-offset-2' align="center">
                       	<br>
                        <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                        <a href='general_journal.php' class='btn btn-danger'>Back</a>
                    </div>            
            </form>
        </div>

    </div>
	</div>
<?php
	addFoot();
?>
