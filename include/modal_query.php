
  <div class="modal" id='modal_comments'>
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="">Message/s</h4>
          </div>
          <div class="modal-body" >
            <div class='' id='comment_table' style=''>
            </div>
          </div>
          <div class='modal-footer'>
            <form method='post' action='save_comment.php' class='disable-submit'>
              <input type='hidden' name='request_id' value='' id='request_id'>
              <input type='hidden' name='dep_head_id' value='' id='dep_head_id'>
              <input type='hidden' name='sender_id' value='<?php echo $_SESSION[APPNAME]['UserId']; ?>'>
              <div class='form-group'>
                <label class='pull-left'>Enter Message:</label>
                <textarea name='reason' required="" class='form-control' style='resize: none' rows='4'></textarea>
              </div>
              <div class='form-group'>
                <button type='submit' class='btn btn-primary'>
                  Send
                </button>
              </div>
            </form>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

