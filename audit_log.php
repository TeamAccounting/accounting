<?php

  require_once('support/config.php');
  if(loggedId()){
    addHead('Audit Log');
    require_once("templates/sidebar.php");
    require_once("templates/navbar.php");
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }
  
  if(!empty($_GET['date_start'])){
    $date_start=date_create($_GET['date_start']);
  }
  else{
    $date_start="";
  }
  if(!empty($_GET['date_end'])){
    $date_end=date_create($_GET['date_end']);
  }
  else{
    $date_end="";
  }

?>


  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Audit Log
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">

            <div class='col-md-12'>
              <?php 
                Alert();
                unsetAlert();
              ?>
              <div class="box box-primary">
                <div class="box-body">
                  <div class="row">
                    <div class='col-sm-12'>
                      <form method='get'>
                      <label class='col-md-2 text-right' >Start Date</label>
                      <div class='col-md-3'>
                        <input type='date' name='date_start' class='form-control' id='date_start' value='<?php echo !empty($_GET['date_start'])?htmlspecialchars($_GET['date_start']):''?>'>
                      </div>
                      <label class='col-md-2 text-right' >End Date</label>
                      <div class='col-md-3'>
                        <input type='date' name='date_end' class='form-control' id='date_end' value='<?php echo !empty($_GET['date_end'])?htmlspecialchars($_GET['date_end']):''?>'>
                      </div>
                      <div class='col-md-2'>
                        <button type='submit'  class=' btn btn-primary' >Filter</button>
                      </div>
                      </form>
                    </div><br><br><br><br>
                    <div class="col-sm-12">
                        <table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                              <th class='text-center'>Employee</th>
                              <th class='text-center'>Action</th>
                              <th class='text-center date-td'>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
  </div>
<script type="text/javascript">
  $(function () {
        $('#ResultTable').DataTable({
                
                "ajax":"php/audit_log.txt",
                "dataSrc": "",
                "order": [[ 2, "desc" ]]
                
               
                //     ]
                
        });
        $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex ) {
            
              var min = Date.parse( '<?php echo !empty($date_start)?date_format($date_start,"Y/m/d"):'';?>' );
              var max = Date.parse( '<?php echo !empty($date_end)?date_format($date_end,"Y/m/d"):'';?>' );
              var age = Date.parse( data[2] ) || 0; // use data for the age column
              // alert(data[2]  );
              if ( ( isNaN( min ) && isNaN( max ) ) ||
                   ( isNaN( min ) && age <= max ) ||
                   ( min <= age   && isNaN( max ) ) ||
                   ( min <= age   && age < max ) )
              {
                  return true;
              }
              return false;
          }
      );


       
      });
</script>
<?php
  
  
  addFoot();
?>