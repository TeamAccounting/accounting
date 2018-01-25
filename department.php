<?php
	require_once('support/config.php');

	if(!AllowUser(array(1,2,3))){
		// echo "wew";
		// die;	
         redirect("index.php");
     }

	if(loggedId()){
		addHead('Departments');
		require_once("templates/sidebar.php");
		require_once("templates/navbar.php");
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}

	
 ?>

<div class="content-wrapper">
	<?php
		include_once('modals/add_user.php');
	?>
<section class="content-header">
	<h2>List of Departments </h2>
	<?php
		Alert();
		unsetAlert();


	?>
	<?php
	  
	  require_once("include/modal_query.php");

	?>
	<div class="box">
	<div class="box-body">

	    <a href="frm_department.php" class="btn btn-primary" style="float:right;" id="btnadd" name="btnadd"><i class="fa fa-plus"></i> &nbsp; Add Department</a>
	</div>
	<div class="box-body">
		<table id='ResultTable' class="table table-striped table-bordered table-hover">
		<thead>
			<tr class="tableheader">
			<th>Department</th>
			
			<th>Weekly Allowance</th>
			<th>Current Expense</th>
			<th>Department Head</th>
	
			<th>ACTION</th>
			</tr>
		</thead>
		<tbody>
			<tr>
	          	
            <?php
			$data=$connection->myQuery("SELECT
 							d.id,d.department_name, d.department_head_id, u.full_name, d.id, d.is_deleted, d.allowance
                        FROM department d
                        INNER JOIN users u ON d.department_head_id=u.user_id
                    	WHERE d.is_deleted = 0

                        ");
				$date = week_range();

				$from = date('Y-m-d', strtotime($date['1']));

				$to = date('Y-m-d', strtotime($date['2']));

                while($row = $data->fetch(PDO::FETCH_ASSOC)):
					
                	echo "<td>".$row['department_name']."</td>";
                	echo "<td>".$row['allowance']."</td>";
					

					$current_expense=$connection->myQuery("SELECT
 							SUM(jd.amount) as amount, jd.request_by, d.id
                        FROM journal_details jd
                        INNER JOIN users u ON jd.request_by=u.user_id
                        INNER JOIN department d ON jd.request_by=d.department_head_id
                        WHERE Jd.date_of_entry between '$from' and '$to' AND jd.is_debit=0 AND d.id=".$row['id'])->fetch(PDO::FETCH_ASSOC);

						$total_credit = $current_expense['amount'];
						if(empty($total_credit)) {
							$total_credit = "No Expenses yet";
						}

						echo "<td>".$total_credit." ";
					
            ?>
            	
            	
	            <?php echo (!empty($total_credit))?" <a href='dep_journal_entry.php?id={$row['department_head_id']}>{$row['department_name']}</a>":NULL ?>

	            </td>
	            
	       
	            <td><?php echo htmlspecialchars($row['allowance'])?></td>
	            <?php
		            $a = array ($row['department_head_id'],$_SESSION[APPNAME]['UserId']);
	                rsort($a);
	                $largest = array_slice($a, 0, 2);
	                $cjay_id=implode($largest);
	            ?>
	            <td><?php echo htmlspecialchars($total_credit)?><small class='label pull-right'><button class='btn btn-sm btn-info'  title='Query Request' onclick='query(<?php echo $cjay_id.",".$row['department_head_id']; ?>)'><span  class='fa fa-question'></span></button></small></td>

	            

	            <td><?php echo htmlspecialchars($row['full_name'])?></td>
	           
	            <td>

	            <a href='frm_department.php?department_id=<?php echo $row['id']; ?>' class='btn btn-success btn-sm'><span class='fa fa-pencil'></span></a>

	            <a href='php/delete_department.php?id=<?php echo $row['id']; ?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger btn-sm'> <span class='fa fa-trash'></span></a>
	            </td>
            </tr>
            <?php
				endwhile;
            ?>
	</div>
	</div>	
</section>
</div>


<script type="text/javascript">



  $(function () {
        $('#ResultTable').DataTable({
            "scrollX": true
            // ,
            // dom: 'Bfrtip',
            //     buttons: [
            //         {
            //             extend:"excel",
            //             text:"<span class='fa fa-download'></span> Download as Excel File "
            //         }
            //         ],

        });
      });





</script>


<?php
	addFoot();
?>