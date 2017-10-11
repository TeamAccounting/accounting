<style>.datepicker{z-index:1200 !important;}</style>

<form  name="JournalEntries" method="post" action="savenewEntry.php">

<div class="modal fade" id='modal_createentry'>

	<div class="modal-dialog">
	
		<div class="modal-content">
		
			<div class="modal-header" style="background-color:#3c8dbc;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h3 class="modal-title" style="color:#fff;">New Journal Entry</h3>
					
					
				<div class="col-lg-6" style="color:#fff;">
					Journal Entry No:
					
					 <?php 
						
						$JournalNumber = ""; 
								if( isset( $_GET['id'])) {
										$JournalNumber = $_GET['id']; 
									} 				
									
						$JournalYear=$connection->myQuery("SELECT EXTRACT(YEAR FROM journal_date) AS JournalYear FROM journals WHERE journal_id=$JournalNumber ORDER BY journal_id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$JournalMonth=$connection->myQuery("SELECT EXTRACT(MONTH FROM journal_date) AS JournalMonth FROM journals WHERE journal_id=$JournalNumber ORDER BY journal_id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$JournalEntryCount=$connection->myQuery("SELECT COUNT(*) AS JournalEntryCount FROM journal_entries WHERE journal_id = $JournalNumber")->fetch(PDO::FETCH_ASSOC);
						
											$JournalYear = implode( " ",$JournalYear);
											$JournalMonth = implode(" ",$JournalMonth);
											$JournalMonth= sprintf("%02s", $JournalMonth);	
											$JournalEntryCount = implode( " ",$JournalEntryCount);
											
											$JournalEntry_ID = substr($JournalYear,2).$JournalMonth.($JournalEntryCount+1); 
											echo $JournalEntry_ID;
											
						?>
						<input type="hidden" name="JournalNumber" value="<?php echo $JournalNumber?>"></input>
						<input type="hidden" name="JournalID" value="<?php echo $JournalEntry_ID?>"></input>
	
				</div>
	
				<div class="input-group date input-group-sm" data-provide="datepicker">
					<input type="text" placeholder="mm/dd/yyyy" name="entry_date" class="form-control" required>
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</div>
				</div>
           </div>
			
	<div class="modal-body" >
	
			
		<!-- Debit Table-->
			
					<div class="form-group form-group-sm col-lg-6">
						<label>Debit</label>		
						<label>Accounts:</label>					
						<select class="form-control" id="selectdr" name="selectdr" required>
							<!-- Insert Options -->
																<?php
								$accounttable =$connection -> myQuery("SELECT account_name,acc_id FROM accounts;");
                           	echo makeOptions($accounttable);
						?>
						</select>
						<br>
					<div id="uexpenses">
					<input type="text" class="form-control" data-allow-clear='True' placeholder="Description" id = "descdr" required>
					</div>	
					<div class="input-group margin input-group-sm">
						<input type="text" class="form-control" placeholder="Amount" id = "AmountDr" onkeypress="return isNumberKey(event)" required>
						<span class="input-group-btn">
								<button type="button" class="btn btn-primary btn-flat " onclick="return Dr();">Add Debit</button>
								<button type="button"  id="dreset" class="btn btn-danger btn-flat">Cancel</button>
						</span>						
					</div>
			
					<div style="overflow: auto; height: 180px;">
						<table class="table table-striped" id="DebitTable">
							<thead id="tblHead">
								<tr>
									<th>Accounts</th>
									<th class="text-right">Amount</th>
									<th class = "col-lg-2">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					
					<input id="debit_total" class="form-control" value="0" placeholder="Total Debit" disabled >
					
				</div>
				
				
				

		<!-- Credit Table-->		
		
					<div class="form-group form-group-sm col-lg-6">
							<label>Credit</label>	
							<label>Accounts:</label>
						<select class="form-control" id="selectcr" name="selectcr">
						<!-- Insert Options -->
							<option disabled selected>Account Title</option>
							<?php
								$accounttable =$connection -> myQuery("SELECT account_name,acc_id FROM accounts;");
			
									while($result = $accounttable->fetch(PDO::FETCH_ASSOC)){
									$CreditTitle= $result['account_name'];
									$AcctID = $result['acc_id'];		
							?>
									<option id = "<?php echo '$AcctID' ?>"  value="<?php echo "$CreditTitle"; ?>"><?php echo "$CreditTitle"; }; ?></option>
						</select>
						<br>
						<div id="uexpenses">
						<input type="text" class="form-control" placeholder="Description" id = "desccr" required>
						</div>
						<div class="input-group margin input-group-sm">
								<input type="text" class="form-control" placeholder="Amount" id = "AmountCr" onchange="change(this);" onkeypress="return isNumberKey(event)">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary btn-flat " onclick="return Cr();">Add Credit</button>
								<button type="button"  id="creset" class="btn btn-danger btn-flat ">Cancel</button>
							</span>
						</div>
					
					
					
					<div style="overflow: auto; height: 180px;">
						<table class="table table-striped" id="CreditTable">
								<thead id="tblHead">
									<tr>
										<th>Accounts</th>
										<th class="text-right">Amount</th>
										<th class="col-lg-2">Action</th>							
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>				
							<input id="credit_total" class="form-control" value="0" placeholder="Total Credit" disabled>
					</div>
					
		
					<div class="form-group">
                  <label>Description:</label>
                  <input class="form-control" name="entry_description" placeholder="Description" onkeypress="return noSpecialChar(event)" required>
                </div>
				

			</div>
			
			
		
		
			<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="clearTable()">Close</button>   
					<button type="submit" id="pass" class="btn btn-primary" onclick="GetCellValues()" disabled>Save changes</button>
			</div>
			
		</div>
	</div>
</div>

</form>



 <script type="text/javascript" src="js/CreateEntry_Functions.js"></script>
 <script type="text/javascript">
    document.getElementById('creset').onclick= function() {
        var field= document.getElementById('AmountCr');
        var field1= document.getElementById('desccr');
        field.value= field.defaultValue;
        field1.value= field1.defaultValue;
    };
	    document.getElementById('dreset').onclick= function() {
        var field= document.getElementById('AmountDr');
        var field1= document.getElementById('descdr');
        field.value= field.defaultValue;
        field1.value= field1.defaultValue;
    };

      $(document).ready(function() {
	    $('#descdr').attr('disabled','disabled');
	    $('#desccr').attr('disabled','disabled');    
	    $('select[name="selectdr"]').on('change',function(){
	    var  others = $(this).val();
	        if(others == "Utilities Expenses"){           
	        $('#descdr').removeAttr('disabled');          
	         }else{
	         $('#descdr').attr('disabled','disabled'); 
	        }  
	      });
	    $('select[name="selectcr"]').on('change',function(){
	    var  others = $(this).val();
	        if(others == "Utilities Expenses"){           
	        $('#desccr').removeAttr('disabled');          
	         }else{
	         $('#desccr').attr('disabled','disabled'); 
	        }  
	      });

    });
</script>