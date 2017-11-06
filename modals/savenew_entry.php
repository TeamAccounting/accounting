 <?php
	require_once('support/config.php');
	if(loggedId()){
		
	}else{
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}
	
?>

 
<script>

var refTab = document.getElementById("DebitTable")
var  ttl;
// Loop through all rows and columns of the table and popup alert with the value
// /content of each cell.
for ( var i = 0; row = refTab.rows[i]; i++ ) {
   row = refTab.rows[i];
   for ( var j = 0; col = row.cells[j]; j++ ) {
      alert(col.firstChild.nodeValue);
   }
}

 </script>
 
 
 

 
 
 <?php
	addFoot();
?>
