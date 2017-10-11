<style>.datepicker{z-index:1200 !important;}</style>

<div class="modal fade" id='modal_createaccount'>
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action='php/addaccount.php'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="color:#fff;" >Create An Account Title</h4>
          </div>
          <div class="modal-body" >
            <div class='form-group'>
				
				
			
        Account Name
          <input type="text" name='fullname' class="form-control" required>
        Account Type
          	<select name='account' required class="form-control">
				<option> </option>
				<option value="admin"> Administrator </option>
				<option value="Accountant"> Accountant </option>
			  </select>				

        Account Number
          <input type="text" name='password' class="form-control" required>
				
            </div>
          </div>
          <div class="modal-footer">
		  
            <button type="submit" class="btn btn-brand btn-flat">Create</button>
			<button type="button" data-dismiss="modal" class="btn btn-brand btn-flat">Cancel</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <script type="text/javascript">
    function createAccount(){
            $('#modal_createaccount').modal('show');	
        }
  </script>
 
 