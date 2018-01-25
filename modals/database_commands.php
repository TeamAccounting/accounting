<?php
  require_once('support/config.php');
  
?>

<div class="modal fade" id='modal_database'>
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
       
          <div class="modal-header" style="background-color:#3c8dbc;">
            <h4 class="modal-title" style="color:#fff;"> <strong> Back Up Tools </strong> </h4>
          </div>
          <div class="modal-body" >
		  
			<button class='btn' onclick='database("backup");'><i class="fa fa-database"></i> Create Back Up</button>
			<button class='btn' onclick='database("restore");'><i class="fa fa-refresh"></i> Restore</button><br><br><br>
			<select name="backups" class="form-control" id="backups" required>
			<option disabled selected value="">Select Restore Point</option>
			<?php
			$files = scandir("DatabaseBackups");
			$newfiles = [];
			foreach($files as $file){
				$info = new SplFileInfo($file);
				if($info->getExtension()=="sql"){
					$newfiles[] = $file;
				echo"<option value='$file'>$file</option>";
			}	
			}
				?>
			</select>
				
            </div>
			   <div class="modal-footer">
		  
      
			<button type="button" data-dismiss="modal" class="btn btn-brand btn-danger"> Close</button>
          </div>
          </div>
       
        
      </div>
    </div>
  </div>
 
 
 <script type='text/javascript'>
 function databaseModal(){
            $('#modal_database').modal('show');	
        }
		
	function database(arg){
		if(arg=='backup'){
			$.get('php/database_commands.php',{command:arg}, function(response){
				console.log(response);
			});
			// alert('wew');
		}
		if(arg=='restore'){
			if(document.getElementById('backups').value!=""){
				document.getElementById('backups').style.borderColor = "green";
				$.get('php/database_commands.php',{command:arg, filename:document.getElementById("backups").value}, function(response){
				console.log(response);
			});
			}else{
				alert("Please Select A Restore Point");
				 document.getElementById('backups').style.borderColor = "red";
			}
		}
	}

</script>


 