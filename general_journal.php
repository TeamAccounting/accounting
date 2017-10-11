<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('General Journal');
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
	<h2> List of General Journals </h2>
	<?php
		Alert();
		unsetAlert();
	?>
	<div class="box">
		<div class="box-body">
				
							
				<button type="submit" class="btn btn-primary" id="btn-add" onclick='createJournal();' name="btnadd" style="float:right;"><i class="fa fa-plus"> &nbsp; Add General Journal</i>
				</button>
				
		
		</div>
	<div class="box-body">
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
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
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	};
	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/edit_journal_form.php?id=" + id;
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
                  "url":"ajax/general_journal.php"
                  
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