<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Dashboard');
		require_once("templates/sidebar.php");
		require_once("templates/navbar.php");
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	$data=$connection->myQuery("SELECT
 							d.department_name, d.department_head_id, u.full_name, d.id, d.is_deleted, d.allowance
                        FROM department d
                        INNER JOIN users u ON d.department_head_id=u.user_id
                    	WHERE d.is_deleted = 0");

?>

<div class="content-wrapper">
    <section class="content-header">
          	<h1 class='page-header text-center text-primary'>
              Dashboard
            </h1> 
    </section>
    <!-- Content Header (Page header) -->
    <?php
    $date = week_range();


// $date['1'];
// echo $date['2'];

	$from = date('Y-m-d', strtotime($date['1']));
	$to = date('Y-m-d', strtotime($date['2']));

	$overall_expense=$connection->myQuery("SELECT
 							SUM(jd.amount) as amount, jd.request_by, u.department_id, d.id, jd.date_of_entry, jd.status_id
                        FROM journal_details jd
                        INNER JOIN users u ON jd.request_by=u.user_id
                        INNER JOIN department d ON jd.request_by=d.department_head_id
                        WHERE jd.date_of_entry between '$from' and '$to' AND jd.is_debit=0 AND jd.status_id = 2")->fetch(PDO::FETCH_ASSOC);

	$total_expense = $overall_expense['amount'];

	$budget= $connection->myQuery("SELECT * FROM budget_per_week LIMIT 1")->fetch(PDO::FETCH_ASSOC);

	if(empty($total_expense)) {
		$total_expense = 0;
	}

	// if ($current_expense['date_of_entry'] > $date['1']) {
	// 	echo "wew";
	// }
  $percent = (($total_expense/$budget['budget'])*100);
	$percentage1 = (($total_expense/$budget['budget'])*100)."%";
    ?>

    <!-- Main content -->
    <section class="content">
      <div class= "col-md-12">
      <div class="row">
        <div class= "box box-primary">
          <div class="box-header with-border">
            <?php if($_SESSION[APPNAME]['UserType'] == 2): ?>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Accounting</h3>

                      Overall Expenses:<br><font size='6px'><?php echo htmlspecialchars($total_expense)?> PHP</font>
        	            </div>&nbsp<b><font size='4px'>
        	            <?php echo  round($percentage1, 2); ?>%</font></b> Overall expenses for this week<br>
        	            <div style="width: 100%">
                      

                			  <div class="col-md-12">
                				  <div class="progress">
                				    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage1; ?>">
                				      <span class="sr-only"></span>
                				    </div>
                				  </div>
                			  </div>
                        <br><br>
                      </div>
                    
                      <a href="budget_per_week.php" class="small-box-footer">
                        View weekly budget <i class="fa fa-arrow-circle-right"></i>
                      </a>
                  </div>
                </div>
            <?php endif; ?>
        

              <?php while($row = $data->fetch(PDO::FETCH_ASSOC)): 




                            $current_expense=$connection->myQuery("SELECT SUM(jd.amount) as amount, jd.request_by, u.department_id, d.id, jd.date_of_entry, jd.status_id
                                      FROM journal_details jd
                                      INNER JOIN users u ON jd.request_by=u.user_id
                                      INNER JOIN department d ON jd.request_by=d.department_head_id
                                      WHERE jd.date_of_entry between '$from' and '$to' AND jd.is_debit=0 AND jd.status_id = 2 AND d.id=".$row['id'])->fetch(PDO::FETCH_ASSOC);

                  $total_credit = $current_expense['amount'];
                  if(empty($total_credit)) {
                  	$total_credit = 0;
                  }

                  // if ($current_expense['date_of_entry'] > $date['1']) {
                  // 	echo "wew";
                  // }
                  $percentage = (($total_credit/$row['allowance'])*100)."%";
                  // $percentage ='100%';
                    

                                          
                  ?>
                    <?php if($_SESSION[APPNAME]['UserType'] == 2 || $row['department_head_id'] == $_SESSION[APPNAME]['UserId']): ?>

                        <div class="col-lg-3 col-xs-6">
                     
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                              <div class="inner">
                                <h3><?php echo htmlspecialchars($row['department_name'])?></h3>

                                Current Expenses:<br><font size='6px'><?php echo htmlspecialchars($total_credit)?> PHP</font>
                  	            </div>&nbsp<b><font size='4px'>
                  	            <?php echo  round($percentage, 2); ?>%</font></b> Expenses for this week<br>
                  	            <div style="width: 100%">
                                

                          			  <div class="col-md-12">
                          				  <div class="progress">
                          				    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage; ?>">
                          				      <span class="sr-only"></span>
                          				    </div>
                          				  </div>
                          			  </div>
                                  <br><br>
                                </div>
                                <?php if($_SESSION[APPNAME]['UserType'] == 2): ?>
                                  <a href="department.php" class="small-box-footer">
                                <?php elseif($row['department_head_id'] == $_SESSION[APPNAME]['UserId']): ?>
                                  <a href="dep_journal_entry.php?id=<?php echo $_SESSION[APPNAME]['UserId']; ?>" class="small-box-footer">
                                    
                                <?php endif; ?>
                                    More info <i class="fa fa-arrow-circ{}e-right"></i>
                                  </a>

                            </div>
                          </div>

                    <?php endif; ?>
                          <!-- /.col -->
                          
              <?php endwhile; ?>

          </div>
        </div>
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>




<?php
	
	
	addFoot();
?>

<script src="js/InitChart.js"></script>
<script type="text/javascript" >

	initChart();

		
</script>

<?php
	include_once('modals/chart_modal.php');
?>
