

<div class="modal fade" id='enlargeChart'>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="POST" action='#'>
          <div class="modal-header" style="background-color:#3c8dbc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="chart_title" style="color:#fff;" >Chart</h4>
          </div>
          <div class="modal-body" >
		  <div class="box box-body">
			<div id="enlargedChart" style="width:100%px;height:50vh;"></div>

            <div class='form-group'>
				
				
            </div>
          </div>
          <div class="modal-footer">
		  
           
			<button type="button" data-dismiss="modal" class="btn btn-brand btn-flat">Close</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <script type="text/javascript">
    function enlargeChart(name,type){
			var delay=1000; //1 second
            $('#enlargeChart').modal('show');		
			$('#chart_title').text(name);
			setTimeout(function() {
			makeChart('enlargedChart',type);
			}, delay);
        }
  </script>
 
 