<?php
  require_once('support/config.php');
  if(loggedId()){
    addHead('Budget per week');
    require_once("templates/sidebar.php");
    require_once("templates/navbar.php");
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }


   $budget= $connection->myQuery("SELECT * FROM budget_per_week LIMIT 1")->fetch(PDO::FETCH_ASSOC);

  
	// makeHead("Approval Flow");
?>



<script type="text/javascript">
    function isNumberKey(evt, element) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
      else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        // alert("wew");
        // document.getElementById("submit-button").disabled = false;
        if (index >= 0 && charCode == 46) {
          return false;
        }
      }
      return true;
    } 
    $(function() {
        var content = $('#submit-input').val();

        $('#submit-input').keyup(function() { 
            if ($('#submit-input').val() != content) {
                content = $('#submit-input').val();
                // alert("wew");
                document.getElementById("submit-button").disabled = false;
            }
        });
    });
        

</script>

<input type="text" id =""></input>

 	<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Budget Per Week
          </h1>
        </section>
        

        <!-- Main content -->
        <section class="content">
            <div class='box box-primary'>
                <div class='box-body'>

                    <div class='col-xs-12 col-md-8 col-md-offset-2'>
                    <div class='row'>
                        <?php
                            Alert();
                            unsetAlert();
                        ?>
                        <form method='post' action='php/save_budget_per_week.php' class='form-horizontal'>
                            <div class='form-group'>
                            <label class='col-md-2'>Budget in Peso:</label>
                            <div class='col-xs-12 col-md-8'>
                             
                                <input type='text' class='form-control' name='budget' <?php echo !(empty($budget))?"value='".$budget['budget']."'":NULL ?> onkeypress="return isNumberKey(event,this)"  placeholder='###' value='' id = "submit-input" required>
                          
                            </div>
                            <div class='col-sm-12 col-md-2' style=''>
                                <button type='submit' class='btn btn-brand' id="submit-button" disabled><span class='fa fa-save'></span> Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                   
                    
                    </div>
                </div>
            </div>
            
          
        </section><!-- /.content -->
  </div>
 <script type="text/javascript" src='js/jquery-sortable.js'></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $('.sortable-table').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            placeholder: '<tr class="placeholder"/>'
          })
      });
  </script>


<?php
  addFoot();
?>
