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

<div class="content-wrapper fixed" >
<!-- add content here-->
	<br>
	<div class="col-lg-12">
		<div class="box box-primary">
		<div class="box box-header with-border">
			<center>
				<i class="fa fa-bar-chart-o" > <h3 class="box-title" >Net Income This Period</h3></i>
				<a class="btn pull-right" onclick="enlargeChart('Net Income This Period','net')" role="button">Enlarge <i class="fa fa-search"></i></a>
			</center>
		</div>
		</div>
		<div class="box box-body">
			 <div id="linegraph" class="table-responsive"  style="width:100%px;height:40vh;"></div>
		</div>
	</div>
	
	<div class=" col-lg-6">
		<div class="box box-primary">
		<div class="box box-header with-border">
			<i class="fa fa-bar-chart-o" > <h3 class="box-title" >Expenses Per Month</h3></i>
			<a class="btn pull-right" onclick="enlargeChart('Expenses Per Month','expense')" role="button">Enlarge <i class="fa fa-search"></i></a>
		</div>	
		</div>
		<div class="box box-body">
			 <div id="linegraph1" class="table-responsive" style="width:50%px;height:25vh;"></div>
		</div>
		
	</div>


	<div class="col-lg-6">
				<div class="box box-primary">
		<div class="box box-header with-border">
			<i class="fa fa-bar-chart-o" > <h3 class="box-title" >Income</h3></i>
			<a class="btn pull-right" onclick="enlargeChart('Income for the period','income')" role="button">Enlarge <i class="fa fa-search"></i></a>
		</div>
		</div>

		<div class="box box-body">
			 <div id="linegraph2" class="table-responsive" style="width:50%px;height:25vh;"></div>
		</div>
	</div>





</div>
	





<?php
	
	
	addFoot();
?>

<script src="js/InitChart.js"></script>
<script type="text/javascript" >

	initChart();

		
</script>

<?php
	include_once('modals/chart_modal.php');
?>
