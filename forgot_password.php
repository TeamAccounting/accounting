<?php
  require_once('support/config.php');
  if(loggedId()){
    // redirect('dash.php');
  }else{
    addHead();
  };

  // var_dump($_POST);
  // die;
  if(!empty($_POST['step'])){
    $user=$connection->myQuery("SELECT * FROM users WHERE username=? AND is_deleted=0 LIMIT 1",array($_POST['username']))->fetch(PDO::FETCH_ASSOC);

    switch ($_POST['step']) {
      case '1':
        

        if(!empty($user)){
          if(empty($user['security_question'])){
            setAlert("You don't have a question set.","danger");
            redirect("index.php");
            die;
          } else {
            $step=2;
            
            $sq = $user['security_question'];
            $pass = $user['answer'];
            $username = $_POST['username'];
          }

          
        }
        else{
          $step=1;
          setAlert("Account does not exist.","danger");
          redirect("forgot_password.php");
            die;
        }
        break;
      case '2':
        if($user['answer'] == $_POST['ans']){
          $username = $_POST['username'];
           $step=3;

        }else{
        
          setAlert("Wrong Answer.","danger");
          redirect("index.php");
          $username = $_POST['username'];;
          // $sq = $_POST['sq'];
          die;
          $step=2;
        }



      break;
      case '3':
        if($_POST['pw1'] == $_POST['pw2']){

          $password=encryptIt($_POST['pw1']);
          $username = $_POST['username'];;

          $connection->myQuery("UPDATE `users` SET `password` = '$password' WHERE `username` = '$username'");
          setAlert("Password saved.","success");


          // die;
          redirect("index.php");
            die;
        }else{
        
          setAlert("Password does not match.","danger");
          // redirect("index.php");
            // die;
          $username = $_POST['username'];;
          $step=3;
        }



      break;
       
    }

    
  }
  else{
    $step=1;
  }
?>







<div class="login-box box box-solid box-primary" style="background-color:#3c8dbc;" align= "center">
  <div class="login-box-header" style="color:#fff;" ><strong><h3>SGTSI Accounting System</h3></strong></div>
    
  <div class="login-box-body">
    <h4>Forgot Password</strong></h4><br>
    <div class="form-horizontal" >
      <?php
        Alert();
        unsetAlert();
      ?>

      <?php
          if($step==1):
      ?>
        <form method="POST" action='forgot_password.php'>
          <div class="has-feedback">
          <input type="hidden"  name="step" value="<?php echo $step; ?>"></input>
          <input class="form-control" type="text"  name="username" placeholder="Username" required></input>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <br>
          <button type="submit" class="form-control btn btn-primary">Submit</button>
          <a href="index.php"><h5>Back to login</strong></h5></a>
          
        </form>

      <?php 
        elseif($step==2):
      ?>
          <form method="POST" action='forgot_password.php'>
          <div class="has-feedback">
          <input type="hidden"  name="step" value="<?php echo $step; ?>"></input>
          <input type="hidden"  name="sq" value="<?php echo $sq; ?>"></input>
          <input type="hidden"  name="username" value="<?php echo $username; ?>"></input>

          <input class="form-control" type="text"  name="sq" value='<?php echo $sq; ?>' disabled></input><br>

          <input class="form-control" type="text"  name="ans" placeholder="Answer" required></input>
          </div>
          
          <br>
          <button type="submit" class="form-control btn btn-primary">Submit</button>
          <a href="index.php"><h5>Back to login</strong></h5></a>
          
        </form>
      <?php 
        elseif($step==3):
      ?>
          <form method="POST" action='forgot_password.php'>
          <div class="has-feedback">
          <input type="hidden"  name="step" value="<?php echo $step; ?>"></input>
          <input type="hidden"  name="username" value="<?php echo $username; ?>"></input>

          <input class="form-control" type="password"  name="pw1" placeholder="New Password" required=""></input><br>

          <input class="form-control" type="password"  name="pw2" placeholder="Confirm Password" required></input>
          </div>
          
          <br>
          <button type="submit" class="form-control btn btn-primary">Submit</button>
          <a href="index.php"><h5>Back to login</strong></h5></a>
          
        </form>
      <?php endif; ?>
    </div>
    
    
  </div>
</div>




<?php
  addFoot();
?>
