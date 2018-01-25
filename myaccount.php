<?php
  require_once('support/config.php');
  if(loggedId()){
    addHead('Edit User');
    require_once("templates/sidebar.php");
        require_once("templates/navbar.php");
    $userid = $_SESSION[APPNAME]['UserId'];
    $query = $connection->myQuery("Select * From users where user_id = $userid")->fetch(PDO::FETCH_ASSOC);
    $username = $query['username'];
    $fullname = $query['full_name'];
    $usertype = $query['user_type'];
    $sq = $query['security_question'];
    $ans = $query['answer'];

    
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

             <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           My Account
          </h1>
        </section>
          <section class="content">
            <div class='box box-primary'>
              <div class='box-body'>

                <div class='col-md-6 col-md-offset-3'> 
                <?php
                    Alert();
                    unsetAlert();
                ?>
                    <form class='form-horizontal' method='POST' action='save_myaccount.php'>
                        <input type='hidden' name='id' value=<?php echo $userid?> >
                
                            <div class='form-group' align='left'>
                                <label class='col-sm-3 control-label'>Username</label>
                                    <div class='col-md-8'>
                                        <input type='hidden' class='form-control' name='username' value='<?php echo $username;?>'>
                                        <input type='text' class='form-control' value='<?php echo $username;?>' disabled>
                                    </div>
                            </div>
                        
                            <div class='form-group' align='left'>
                                <label class='col-sm-3 control-label'>Full Name</label>
                                    <div class='col-md-8'>
                                        <input type='text' class='form-control' name='name' placeholder='FirstName' value='<?php echo $fullname;?>' required>
                                    </div>
                            </div>

                            <div class='form-group' align='left'>
                                <label class='col-sm-12 col-md-3 control-label'>Password</label>
                                    <div class='col-md-8'>
                                        <input type='password' class='form-control' name='password' placeholder='Enter new password' value='' required>
                                    </div>
                            </div>
                            <div class='form-group' align='left'>
                                <label class='col-sm-3 control-label'>Security Question</label>
                                    <div class='col-md-8'>
                                        <input type='text' class='form-control' name='security_question' placeholder='Security Question' value='<?php echo $sq;?>' required>
                                    </div>
                            </div>
                            <div class='form-group' align='left'>
                                <label class='col-sm-3 control-label'>Answer</label>
                                    <div class='col-md-8'>
                                        <input type='text' class='form-control' name='answer' placeholder='Answer' value='<?php echo $ans;?>' required>
                                    </div>
                            </div>
                         


                                <div class='col-md-8 col-md-offset-2' align="center">
                                    <br>
                                    <button type='submit' class='btn btn-success'> <span class='fa fa-check'></span> &nbsp; Save Changes</button>
                                  
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
