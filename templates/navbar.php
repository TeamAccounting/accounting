<?php
	require_once('support/config.php');

	
	  require_once("include/modal_query.php");


 ?>
 <header class="main-header" >
   <a href="dash.php" class="logo">
	<span class="logo-lg">
		Accounting System
	</span>
	<span class="logo-lg-mini">
		AS
	</span>
   </a>
  <nav class="navbar navbar-static-top">
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      </a>
	  
	<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<?php 
				$user_id = $_SESSION[APPNAME]['UserId'];
          		$message=$connection->myQuery("SELECT COUNT(qm.id) AS total, qm.sender_id, qm.read, qm.receiver_id,u.user_id,u.full_name,qm.message,qm.query_id,qm.sender_id FROM query_message qm 
          			INNER JOIN users u ON qm.sender_id=u.user_id
          			WHERE qm.read='0' AND qm.receiver_id = {$user_id} ")->fetch(PDO::FETCH_ASSOC);

						

						
			?>
			<?php if($message['total'] > 0): ?>
            <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $message['total']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $message['total']; ?> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php 
                $message_info=$connection->myQuery("SELECT qm.id, qm.sender_id, qm.read, qm.receiver_id,u.user_id,u.full_name,qm.message,qm.query_id,qm.sender_id FROM query_message qm 
          			INNER JOIN users u ON qm.sender_id=u.user_id
          			WHERE qm.read='0' AND qm.receiver_id = {$user_id} ");

                while($row = $message_info->fetch(PDO::FETCH_ASSOC)): ?>
                  <li><!-- start message -->

                    <a href="#" onclick='query(<?php echo $row['query_id'].",".$row['sender_id']; ?>)'>
                      <div class="pull-left">
                        <img src="image/defUser.jpeg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $row['full_name']; ?>
                     
                      </h4>
                      <p> <?php echo $row['message']; ?></p>
                    	
                    </a>
                  </li>
                 <?php endwhile; ?>
                  <!-- end message -->
                 
                </ul>
              </li>
             
            </ul>
          	</li>
          	<?php endif; ?>
			<li><a data-toggle="control-sidebar"><i class="fa fa-calculator"></i> <span>Multi-Function Calculator</span></a></li>
			
			<li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                  

                  <span class="hidden-xs"><?php echo $_SESSION[APPNAME]['FullName']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="image/defUser.jpeg" class="img-circle" alt="User Image">
                    <p>
                     <?php echo $_SESSION[APPNAME]['FullName']; ?>
                      <small> <?php

                      echo user_type($_SESSION[APPNAME]['UserType'])['name']; ?> </small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   	<div class="pull-left">
                      <a href="myaccount.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="php/LoggingOut.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
		</ul>
	</div>	
	
  </nav>
</header>

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
    
			function validateForm()
		    {
		        
		    }

</script>

<aside class="control-sidebar control-sidebar-light">
  <!-- Content of the sidebar goes here -->
  
  <div class="box box-info">
        <div class="box-header with-border">
          <h5 class="box-title">Cost Of Goods Sold</h5>
        </div><!-- /.box-header -->
        <div class="box-body">
		<form id="CostOfGoods" method="post" name="Form">
          <div class="input-group">
                <input class="form-control input-sm" name="cgs1" onkeypress="return isNumberKey(event,this)" placeholder="Beginning Inventory" id="beg_inv" type="text" required>
           </div>
		   +
		   <div class="input-group">
                <input class="form-control input-sm" name="cgs2" onkeypress="return isNumberKey(event,this)" placeholder="Purchases" id="purchase" type="text">
           </div>
		   -
		   <div class="input-group">
                <input class="form-control input-sm" name="cgs3" onkeypress="return isNumberKey(event,this)" placeholder="Ending Inventory" id="end_inv"  type="text">
           </div>
		   =
		   <div class="input-group">
                <input class="form-control input-sm" placeholder="Cost Of Goods Sold" id="cod" disabled type="text">
           </div>
		   <br>
				<button type="button" onclick="return CODS()" class="btn bg-olive btn-xs">Compute</button>
				<button type="reset" class="btn bg-maroon btn-xs">Clear</button>
		</form>
        </div><!-- /.box-body -->
      </div>
	  
	  
	  
	  <!-- Calculate CODS -->
		<script>
			function CODS(){
				 // alert("Please Fill All Required Field");
				var a=document.forms["Form"]["cgs1"].value;
		        var b=document.forms["Form"]["cgs2"].value;
		        var c=document.forms["Form"]["cgs3"].value;
		       
		        if (a==null || a=="",b==null || b=="",c==null || c=="")

		        {
		            // alert("Please Fill All Required Field");
		            return false;
		        } else {
				var beg_inv = parseFloat(document.forms["CostOfGoods"]["beg_inv"].value);
				var purchase = parseFloat(document.forms["CostOfGoods"]["purchase"].value);
				var end_inv = parseFloat(document.forms["CostOfGoods"]["end_inv"].value);				
				var display = document.getElementById("cod");
				display.value = parseFloat(beg_inv + purchase - end_inv).toFixed(2);
				
				return false;}

				}
		</script>
	  
	  
	  
	  
	  
	  <div class="box box-info">
        <div class="box-header with-border">
          <h4 class="box-title">Depreciation Value</h4>
        </div><!-- /.box-header -->
        <div class="box-body">
		<form id="Depreciation" method="post">
				<div class="input-group">
					 <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="(Initial Cost"id="initial_cost" type="text">
				</div>
				-
				<div class="input-group">
					<input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Scrap Value)" id="scrap_value" type="text">
				</div>
				/
				<div class="input-group">
					<input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Life Expectancy" id="life_expectancy" type="text">
					<span class="input-group-addon input-sm">yrs</span>
				</div>
				=
				<div class="input-group">
					<input class="form-control input-sm" placeholder="Depreciation Expense" id="dv" disabled type="text">
				</div>
			<br>
			<button type="submit" onclick="return DV()" class="btn bg-olive btn-xs">Compute</button>
			<button type="reset" class="btn bg-maroon btn-xs">Clear</button>
		</form>
        </div><!-- /.box-body -->
      </div>
	  
	  
	  
	  
	  
	  	<!-- Calculate DV -->
		<script>
			function DV(){
				var initial_cost = parseFloat(document.forms["Depreciation"]["initial_cost"].value);
				var scrap = parseFloat(document.forms["Depreciation"]["scrap_value"].value);
				var life = parseFloat(document.forms["Depreciation"]["life_expectancy"].value);				
				var display = document.getElementById("dv");
				display.value = parseFloat((initial_cost - scrap) / life).toFixed(2);
				
				return false;}
				
		</script>
	  
	  
	  
	  
	  
	    <div class="box box-info">
        <div class="box-header with-border">
          <h4 class="box-title">Balance Reduction</h4>
        </div><!-- /.box-header -->
        <div class="box-body">
		<form id="Balance" method="post">
          <div class="input-group">
               <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="(Initial Cost" id="initial_cost" type="text">
           </div>
		   -
		   <div class="input-group">
                <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Accumulated Depreciation" id="accumulated_depreciation" type="text">
           </div>
		   -
		   <div class="input-group">
                <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Scrap Value)" id="scrap_value" type="text">
           </div>
		   *
		   <div class="input-group">
                <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Percentage" id="percentage" type="text">
           </div>
		   =
		   <div class="input-group">
                <input class="form-control input-sm" onkeypress="return isNumberKey(event,this)" placeholder="Annual Depreciation Expense" id="br" disabled type="text">
           </div>
		   <br>
			<button type="submit" onclick="return BR()" class="btn bg-olive btn-xs">Compute</button>
			<button type="reset" class="btn bg-maroon btn-xs">Clear</button>
		</form>
        </div><!-- /.box-body -->
      </div>
	  
	  
	  
	  
	  	<!-- Calculate BR -->
		<script>
			function BR(){
				var initial = parseFloat(document.forms["Balance"]["initial_cost"].value);
				var acum_dep = parseFloat(document.forms["Balance"]["accumulated_depreciation"].value);
				var scrap = parseFloat(document.forms["Balance"]["scrap_value"].value);
				var percent = parseFloat(document.forms["Balance"]["percentage"].value);				
				var display = document.getElementById("br");
				display.value = parseFloat((initial - acum_dep - scrap ) * percent).toFixed(2);
				
				return false;}
				
		</script>
	  
	  
	  
	  
 </div>
</aside>
<div class="control-sidebar-bg"></div>
</div>
<?php
	addFoot();
?>