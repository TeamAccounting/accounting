<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Archived Journals');
		addNavBar();
		addSideBar();
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}s
?>

<div class="content-wrapper">
	<?php
		
	?>
<section class="content-header">
	<h2> Archived Journals </h2>
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
					<th>ID</th>
					<th>DATE OF JOURNAL</th>
					<th>MONTH YEAR</th>
					<th>DESCRIPTION</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr class="tableheader"> -->

					
			</tbody>
		</table>
	</div>
	</div>
	</div>
</section>

 
</div>

<script type="text/javascript">

	function redirect(id){
	
		
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	}
	
	function archive(id){
		
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/unarchive.php?id=" + id;
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
                  "url":"ajax/archived_journals.php"
                  
                },"language": {
                    "zeroRecords": "General Journal Not Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [	
                    { "orderable": false, "targets": [-1] }
                  ] 
        });
        
    });
    
</script>