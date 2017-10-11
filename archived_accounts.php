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
		include_once('modals/create_journal.php');
	?>
<section class="content-header">
	<h2> Archived Accounts </h2>
	<?php
		Alert();
		unsetAlert();
	?>
	<div class="box">
		<div class="box-body">
				<input type="text" class="container-fluid" size="30" name="search" placeholder="Search">
				<button type="submit" class="btn btn-primary" id="btn-search" name="btnsearch"><i class="fa fa-search"></i> </button>
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
	
	function unarchive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/unarchive_account.php?id=" + id;
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
                "searching": true,
                "processing": true,
                "serverSide": true,
                "select":true,
                "ajax":{
                  "url":"ajax/archived_accounts.php"
                  
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