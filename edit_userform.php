<?php
	require_once('support/config.php');
	if(loggedId() && isset($_GET['id'])){
		addHead('Edit User');
		require_once("templates/sidebar.php");
        require_once("templates/navbar.php");
		$userid = $_GET['id'];
		$query = $connection->myQuery("Select * From users where user_id = $userid")->fetch(PDO::FETCH_ASSOC);
		$username = $query['username'];
		$fullname = $query['full_name'];
        $usertype = $query['user_type'];
        $password = decryptIt($query['password']);

		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}		


    $user_type=$connection->myQuery("SELECT * FROM user_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);

    $user_type_selected=$connection->myQuery("SELECT * FROM user_type WHERE id=? LIMIT 1",array($usertype))->fetch(PDO::FETCH_ASSOC);

    $dep=$connection->myQuery("SELECT * FROM Department WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);

    $dep_selected=$connection->myQuery("SELECT * FROM users WHERE user_id=? LIMIT 1",array($userid))->fetch(PDO::FETCH_ASSOC);
		

?>

    <div class="content-wrapper">
        <section class="content-header">
          <h1>
          Edit an Account
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
                        <form class='form-horizontal' method='POST' enctype="multipart/form-data" action='php/edit_user.php'>
                            <input type='hidden' name='id' value=<?php echo $userid?> >
              			
                                <div class='form-group' align='left'>
                                    <label class='col-sm-3 control-label'>UserName</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='username'  value=<?php echo $username;?> required>
                                        </div>
                                </div>
            								
            				    <div class='form-group' align='left'>
                                    <label class='col-sm-3 control-label'>FirstName</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='name' placeholder='FirstName' value=<?php echo $fullname;?> required>
                                        </div>
                                </div>

            					<div class='form-group' align='left'>
                                    <label class='col-sm-12 col-md-3 control-label'>Password</label>
                                        <div class='col-md-8'>
                                            <input type='password' class='form-control' name='password' placeholder='Enter new password' value='<?php echo $password; ?>' required>
                                        </div>
                                </div>
            					
                                <div class='form-group'>
            					    <label class='col-sm-12 col-md-3 control-label'>User Type</label>
            							<div class='col-md-8'>
            								<!-- <select class="form-control cbo" name='account' required>
                                              
            						      		
            									<option value="Administrator"> Administrator </option>
            									<option value="Accountant"> Accountant </option>
            								</select> -->

                                            <select class='form-control cbo' name='account' data-allow-clear='True' data-placeholder='Select User Type' <?php echo !(empty($user_type_selected))?"data-selected='".$user_type_selected['id']."'":NULL ?> required>
                                                        <
                                                        <?php echo makeOptions($user_type); ?>
                                                     
                                                        
                                                           
                                            </select>

            							</div>

            					</div>
                               


                                    <div class='col-md-8 col-md-offset-2' align="center">
                                        <br>
                                        <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                                        <a href='users.php' class='btn btn-danger'>Back</a>
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
