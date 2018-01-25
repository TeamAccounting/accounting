

<div class="modal fade" id='modal_registerBalance'>
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form method="POST" action='php/registering_balance.php'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="color:#fff;"><strong> Create a Balance </strong></h4>
          </div>
          <div class="modal-body">
            <div class='form-group'>
				YEAR
        
          <input type="number" min="1900" max="2099" name='year' step="1" class="form-control" value="<?php echo date("Y"); ?>" required> <br>
        AMOUNT
          <input type="number" name='amount' class="form-control" required> <br>
          <div class='col-lg-offset-3'>
          <button type="submit" class="btn btn-brand btn-flat btn-success">Create</button>
          <button type="button" data-dismiss="modal" class="btn btn-brand btn-flat btn-danger">Cancel</button>
          </div>
          </div>
          </div> 
          <div class="modal-footer">
          </div>

        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <script type="text/javascript">
    function addBalance(){
            $('#modal_registerBalance').modal('show');	
        }
  </script>
 
 