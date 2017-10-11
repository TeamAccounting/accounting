<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Restore Tools');
		addNavBar();
		addSideBar();
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
?>

<div class="content-wrapper fixed">

<button class='btn' onclick='database("backup");'>Create Back Up</button>
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
<button class='btn' onclick='database("restore");'>Restore</button>
</div>
	




<?php
	
	
	addFoot();
?>
<script type='text/javascript'>
	function database(arg){
		if(arg=='backup'){
			$.get('php/database_commands.php',{command:arg}, function(response){
				console.log(response);
			});
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

