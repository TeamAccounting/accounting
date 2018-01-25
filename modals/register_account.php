

<div class="modal fade" id='modal_registerAccount'>
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form method="POST" action='php/registering_account.php'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="color:#fff;"><strong> Create an Account </strong></h4>
          </div>
          <div class="modal-body">
            <div class='form-group'>
				ACCOUNT NO.
          <input type="text" name='acctno' class="form-control" required> <br>
        ACCOUNT NAME
          <input type="text" name='acctname' class="form-control" required> <br>
        ACCOUNT TYPE
          <br>
          <select name='accttype' required class="form-control">
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
          
          <div class="modal-footer">
          <button type="submit" class="btn btn-brand btn-flat btn-success">Create</button>
			    <button type="button" data-dismiss="modal" class="btn btn-brand btn-flat btn-danger">Cancel</button>
          </div>

        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <script type="text/javascript">
    function addAccount(){
            $('#modal_registerAccount').modal('show');	
        }
  </script>
 
 