<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Chart Of Accounts');
		addNavBar();
		addSideBar();
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
?>

<div class="content-wrapper">
	<?php
		include_once('modals/register_account.php');
	?>
<section class="content-header">
	<h2> Chart Of Accounts </h2>
	<?php
		Alert();
		unsetAlert();
	?>
	<div class="box">
		<div class="box-body">
				
				<button type="submit" class="btn btn-primary" id="btn-add" onclick='addAccount();' name="btnadd" style="float:right;"><i class="fa fa-plus"> &nbsp; Register an Account</i></button>
		</div>
	<div class="box-body">
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr class="tableheader">
					<th>Account No</th>
					<th>Name of Account</th>
					<th>Type of Account</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				

					
			</tbody>
		</table>
	</div>
	</div>
	</div>
</section>

 
</div>

<script type="text/javascript">


	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive_account.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/edit_account.php?id=" + id;
		window.location=string;
	}
	
</script>





<?php
	addFoot();
?>
<script>
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
                "serverSide": true,
                "select":true,
                "ajax":{
                  "url":"ajax/chart_of_accounts.php"
                  
                },"language": {
                    "zeroRecords": "Account Not Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [	
                    { "orderable": false, "targets": [-1] }
                  ] 
        });
        
    });
    
</script>