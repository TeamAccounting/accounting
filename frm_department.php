<?php
	require_once('support/config.php');


	if(loggedId()){
		addHead('frm department');
		require_once("templates/sidebar.php");
        require_once("templates/navbar.php");
	
		
		
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}		



    $user=$connection->myQuery("SELECT * FROM users WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($_GET['department_id'])) {

        $dep_id =$_GET['department_id'];

        $dep_info=$connection->myQuery("SELECT * FROM department WHERE id=? LIMIT 1",array($dep_id))->fetch(PDO::FETCH_ASSOC);

        $user_selected=$connection->myQuery("SELECT * FROM department WHERE id=? LIMIT 1",array($dep_id))->fetch(PDO::FETCH_ASSOC);

    }
		
?>
<script type="text/javascript">
    function isNumberKey(evt, element) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
      else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        //alert(index);
        
        if (index >= 0 && charCode == 46) {
          return false;
        }
      }
      return true;
    } 
    

</script>

    <div class="content-wrapper">

        
        <section class="content-header">
          <h1>
          Department
          </h1>
         
        </section>
        <section class="content">
            <div class='box box-primary'>
                <div class='box-body'>
                 <?php
                    Alert();
                    unsetAlert();
                ?>
                    <div class='col-md-6 col-md-offset-3'> 
                        <form class='form-horizontal' method='POST' enctype="multipart/form-data" action='php/save_department.php'>
                        <?php if(!empty($_GET['department_id'])) {
                            echo "<input type='hidden' name='id' value='".$dep_id."'>";
                            } ?>
              			
                                <div class='form-group' align='left'>
                                    <label class='col-sm-3 control-label'>Department Name</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='dep_name' placeholder='Department Name' value='<?php echo !empty($dep_id)?htmlspecialchars($dep_info['department_name']):''; ?>' required>
                                        </div>
                                </div>
            								
            				    <div class='form-group' align='left'>
                                    <label class='col-sm-3 control-label'>Weekly Allowance</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='allowance' placeholder='Allowance' value='<?php echo !empty($dep_id)?htmlspecialchars($dep_info['allowance']):''; ?>' onkeypress="return isNumberKey(event,this)" required>
                                        </div>
                                </div>

            		
                                <div class='form-group'>
            					    <label class='col-sm-12 col-md-3 control-label'>Department Head</label>
            							<div class='col-md-8'>
            								<!-- <select class="form-control cbo" name='account' required>
                                              
            						      		
            									<option value="Administrator"> Administrator </option>
            									<option value="Accountant"> Accountant </option>
            								</select> -->

                                            <select class='form-control cbo' name='dep_head' data-allow-clear='True' data-placeholder='Select Department Head' <?php echo !(empty($dep_id))?"data-selected='".$dep_info['department_head_id']."'":NULL ?>  required>
                                                       
                                                        <?php echo makeOptions($user); ?>
                                                     
                                                        
                                                           
                                            </select>

            							</div>

            					</div>

                                    <div class='col-md-8 col-md-offset-2' align="center">
                                        <br>
                                        <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                                        <a href='department.php' class='btn btn-danger'>Back</a>
                                    </div>

                                        
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
	addFoot();
?>
