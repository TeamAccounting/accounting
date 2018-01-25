<?php
  require_once('support/config.php');
  $data=$connection->myQuery("SELECT
              user_id,
              full_name,
              username,
              user_type
            FROM users
            ");

  $user_type=$connection->myQuery("SELECT * FROM user_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="modal fade" id='modal_adduser'>
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form method="POST" action='php/adding_user.php'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <h4 class="modal-title" style="color:#fff;"> <strong> Add User </strong> </h4>
          </div>
          <div class="modal-body" >
            <div class='form-group'>
              Full Name
                <input type="text" name='fullname' class="form-control" required> <br>
              Username
                <input type="text" name='username' class="form-control" required> <br>
              Password
                <input type="password" name='password' class="form-control" required> <br>
      <!--         Confirm Password
                <input type="text" class="form-control" required> -->
              User Type
        			  
                <select class='form-control' name='account' data-allow-clear='True' data-placeholder='Select User Type' required>
                                                        <
                    <?php echo makeOptions($user_type); ?>
                                                     
                                                        
                                                           
                </select>
            </div>
          </div>
          <div class="modal-footer">
		  
      <button type="submit" class="btn btn-brand btn-success"> Add </button>
			<button type="button" data-dismiss="modal" class="btn btn-brand btn-danger"> Cancel </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
    function addUser(){
            $('#modal_adduser').modal('show');	
        }
  </script>
 
 