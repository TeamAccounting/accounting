<div class="alert alert-<?php echo $_SESSION[APPNAME]['alerttype'];?> alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
	</button>
	<?php echo $_SESSION[APPNAME]['alertcontent'];?>
</div>