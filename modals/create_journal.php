<style>.datepicker{z-index:1200 !important;}</style>

<div class="modal fade" id='modal_createjournal'>
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action='php/addJournal.php'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="color:#fff;" >Create A Journal</h4>
          </div>
          <div class="modal-body" >
            <div class='form-group'>
				DATE OF JOURNAL
				<div class="input-group date" data-provide="datepicker">
					<input type="text" placeholder="mm/dd/yyyy" name="date" class="form-control" style="position: relative; z-index: 100000;" required>
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</div>
				</div>
        <br>
				DESCRIPTION
				 <textarea name='desc' required="" maxlength="100" placeholder="Enter Journal Description (100 chars)" class='form-control' style='resize: none' rows='4'></textarea>
				
            </div>
          </div>
          <div class="modal-footer">
		  
            <button type="submit" class="btn btn-success">Create</button>
			<button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <script type="text/javascript">
    function createJournal(){
            $('#modal_createjournal').modal('show');	
        }
  </script>
 
 