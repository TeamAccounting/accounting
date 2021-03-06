<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Users');
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
	<h2>List of Users </h2>
	<?php
	
		Alert();
		// die;
		unsetAlert();
	?>
	<div class="box">
	<div class="box-body">
	    <button type="submit" class="btn btn-primary" style="float:right;" id="btnadd" name="btnadd" onclick="addUser()"><i class="fa fa-plus"></i> &nbsp; Add User</button>
	</div>
	<div class="box-body">
		<table id='ResultTable' class="table table-striped table-bordered table-hover">
		<thead>
			<tr class="tableheader">
			<th>ID</th>
			<th>FULL NAME</th>
			<th>USER NAME</th>
			<th>USER TYPE</th>
			<th>ACTION</th>
			</tr>
		</thead>
		<tbody>
            <?php
			$data=$connection->myQuery("SELECT
 							u.user_id, u.full_name, u.username, u.user_type, ut.name, u.is_deleted
                        FROM users u
                        INNER JOIN user_type ut on u.user_type=ut.id

                        ");
                while($row = $data->fetch(PDO::FETCH_ASSOC)){
					if($row["is_deleted"]==1)
					{}else{
            ?>
            <tr>
	            <td><?php echo htmlspecialchars($row['user_id'])?></td>
	            <td><?php echo htmlspecialchars($row['full_name'])?></td>
	            <td><?php echo htmlspecialchars($row['username'])?></td>
	            <td><?php echo htmlspecialchars($row['name'])?></td>
	            <td>
	            <a href='edit_userform.php?id=<?php echo $row['user_id']; ?>' class='btn btn-success btn-sm'><span class='fa fa-pencil'></span></a>
	            <a href='php/deleteuser.php?id=<?php echo $row['user_id']; ?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger btn-sm'> <span class='fa fa-trash'></span></a>
	            </td>
            </tr>
            <?php
				}
			}
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