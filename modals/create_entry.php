<style>.datepicker{z-index:1200 !important;}</style>

<form  name="JournalEntries" method="post" action="savenewEntry.php">

<div class="modal fade" id='modal_createentry'>

	<div class="modal-dialog modal-lg">
	
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
					<input type="text" placeholder="mm/dd/yyyy" name="entry_date" value="<?php echo date('m/d/Y'); ?>" class="form-control" required>
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
							$accounttable =$connection -> myQuery("SELECT type,account_name FROM accounts;")->fetchAll(PDO::FETCH_ASSOC);
                           	echo makeOptions($accounttable);
						?>
						</select>
						<br>
					<div id="uexpenses">
					<input type="text" class="form-control" data-allow-clear='True' placeholder="Account Description" id = "descdr">
					</div><br>
					<div id="accpaydr" style='display:none;'>
					<input type="text" class="form-control" data-allow-clear='True' placeholder="Bank Name" id = "bankdr"><br>
					<input type="number" class="form-control" data-allow-clear='True' placeholder="Cheque Number" id = "chqdr">
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
									<th class="col-lg-2">Description</th>
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
							<?php
								$accounttable =$connection -> myQuery("SELECT type,account_name FROM accounts;")->fetchAll(PDO::FETCH_ASSOC);
								echo makeOptions($accounttable);
							?>
						</select>
						<br>
						<div id="uexpenses">
						<input type="text" class="form-control" placeholder="Description" id = "desccr">
						</div><br>
						<div id="accpaycr" style='display:none;'>
						<input type="text" class="form-control" data-allow-clear='True' placeholder="Bank Name" id = "bankcr"><br>
						<input type="number" class="form-control" data-allow-clear='True' placeholder="Cheque Number" id = "chqcr">
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
										<th class="col-lg-2">Description</th>
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
                  <label>Remarks:</label>
                  <input class="form-control" name="entry_description" placeholder="Enter Remarks" onkeypress="return noSpecialChar(event)" required>
                </div>
				

			</div>
			
			
		
		
			<div class="modal-footer"><center>
					<button type="submit" id="pass" class="btn btn-primary" onclick="GetCellValues()" disabled>Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearTable()">Close</button> 
					</center>
			</div>
			
		</div>
	</div>
</div>

</form>



 <script type="text/javascript" src="js/CreateEntry_Functions.js"></script>
 <script type="text/javascript">

 		
		function GetCellValues() {
			var amount = document.getElementById("credit_total");
		  
			// alert("wew");
		    if (amount.value > 10000) {
		    	alert("Value is morethan 10,000.00PHP, This is needed to be approved by the finance");
			}
		}

    document.getElementById('creset').onclick= function() {
        var field= document.getElementById('AmountCr');
        var field1= document.getElementById('desccr');
        var field2= document.getElementById('bankcr');
        var field3= document.getElementById('chqcr');
        field.value= field.defaultValue;
        field1.value= field1.defaultValue;
        field2.value= field2.defaultValue;
        field3.value= field3.defaultValue;
    };
	    document.getElementById('dreset').onclick= function() {
        var field= document.getElementById('AmountDr');
        var field1= document.getElementById('descdr');
        var field2= document.getElementById('bankdr');
        var field3= document.getElementById('chqdr');
        field.value= field.defaultValue;
        field1.value= field1.defaultValue;
        field2.value= field2.defaultValue;
        field3.value= field3.defaultValue;
    };

      $(document).ready(function() {
	  $('#selectdr').on('change', function() {
      if (( this.value == '6')||( this.value == '7'))
      {
        $("#accpaydr").show();
      }
      else
      {
        $("#accpaydr").hide();
      }
    });
	  $('#selectcr').on('change', function() {
      if (( this.value == '6')||( this.value == '7'))
      {
        $("#accpaycr").show();
      }
      else
      {
        $("#accpaycr").hide();
      }
    });
    });
</script>