<?php
  require_once('support/config.php');
  if(loggedId()){
    addHead('Cash Request');
    require_once("templates/navbar.php");
    require_once("templates/sidebar.php");
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }
  
  if (!empty($_GET['journal_entry'])) {
    $id=$_GET['journal_entry'];

    $cjay_id=$connection->myQuery("SELECT journal_details_id from cash_request WHERE id =".$id)->fetch(PDO::FETCH_ASSOC);
// echo $cjay_id['journal_details_id'];
    $journal_id=explode(",", $cjay_id['journal_details_id']);

    for($x = 0; $x <= count($journal_id)-1; $x++) {
      // echo $journal_id[$x];
    }
   
    $journal_entry=$connection->myQuery("SELECT a.account_name, jd.account_id, jd.amount, jd.is_debit, cr.request_by, cr.journal_entry_no, cr.journal_id, cr.date_of_entry, cr.description, cr.status_id,cr.approver_id,cr.total_amount, u.full_name, j.description AS journal_des, j.journal_date, jd.desc AS reason FROM cash_request cr 
      INNER JOIN users u ON cr.request_by=u.user_id
      INNER JOIN journal_details jd ON cr.journal_entry_no=jd.journal_entry_no
      INNER JOIN accounts a ON jd.account_id=a.acc_id
      INNER JOIN journals j ON cr.journal_id=j.journal_id
      WHERE cr.id = ".$id ." AND jd.id in (".$cjay_id['journal_details_id'].")")->fetchAll(PDO::FETCH_ASSOC);

    $journal_date=$connection->myQuery("SELECT cr.id,cr.journal_id,j.journal_date,j.description FROM cash_request cr 
      
      INNER JOIN  journals j ON cr.journal_id=j.journal_id
      WHERE cr.id=".$id)->fetch(PDO::FETCH_ASSOC);  
      // var_dump($journal_entry);

      // $date_modal=date_create($journal_entry['date_of_entry']);
      // var_dump($journal_entry);
      // die;
// die;
  } 
?>



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            My Cash Request
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
                    <div class="col-sm-12">

                        <table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                                                
                                                <th class='text-center'>DATE OF JOURNAL</th>
                                                <th class='text-center'>MONTH YEAR</th>
                                                <th class='text-center'>DESCRIPTION</th>
                                                <th class='text-center'>TOTAL AMOUNT</th>
                                                <th class='text-center'>STATUS</th>
                                                <th class='text-center'>Approver</th>
                              <th class='text-center' style='min-width:100px'>ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php


                                                $approver_id = $_SESSION[APPNAME]['UserId'];

                                                $organizations=$connection->myQuery("SELECT cr.id,cr.request_by, cr.journal_entry_no, cr.journal_id, cr.date_of_entry, cr.description, cr.status_id,cr.approver_id,cr.total_amount, u.full_name, j.journal_date FROM cash_request cr 
                                                  INNER JOIN users u ON cr.request_by=u.user_id  
                                                  INNER JOIN  journals j ON cr.journal_id=j.journal_id
                                                  WHERE cr.request_by = ".$approver_id)->fetchAll(PDO::FETCH_ASSOC);
                                                 
                                          

                                                  foreach ($organizations as $row):
                                            ?>
                                                <tr>
                                                        
                                                        <td>
                                                          <?php echo htmlspecialchars($row['journal_date']); ?>
                                                        </td>
                                                        <td>
                                                         <?php 
                                                          $date=date_create($row['journal_date']);
                                                           
                                      
                                                          echo $date->format("F Y");
                                                              ?>
                                                        </td>
                                                        <td>
                                                          <?php echo htmlspecialchars($row['description']); ?>
                                                        </td>
                                                        <td>
                                                          <?php echo htmlspecialchars($row['total_amount']); ?>
                                                        </td>

                                                       
                                                            <td>
                                                               <?php
                                                               $status=$connection->myQuery("SELECT * FROM request_status
                                                              -- INNER JOIN users u ON rs.request_by=u.user_id  
                                                              -- INNER JOIN  journals j ON cr.journal_id=j.journal_id
                                                              WHERE id = ".$row['status_id'])->fetch(PDO::FETCH_ASSOC);

                                                               echo $status['request_name'];
                                                              ?>
                                                            </td>
                                                            <td>
                                                               <?php
                                                               $Approver=$connection->myQuery("SELECT * FROM users
                                                              -- INNER JOIN users u ON rs.request_by=u.user_id  
                                                              -- INNER JOIN  journals j ON cr.journal_id=j.journal_id
                                                              WHERE user_id = ".$row['approver_id'])->fetch(PDO::FETCH_ASSOC);
                                                               if ($row['status_id']!='4'):
                                                               echo $Approver['full_name'];
                                                                endif;
                                                              ?>
                                                            </td>

                                                             <td>
                                                                <a class='btn btn-sm btn-primary' href='pending_request.php?journal_entry=<?php echo $row['id'] ;?>&type=request'><span class='fa fa-search'></span></a>
                                                                <?php if ($row['status_id'] == '1'): ?>
                                                                <a class='btn btn-sm btn-danger' href='cancel_request.php?id=<?php echo $row['id'];?>' onclick='return confirm("Cancel Request?.")'><span class='fa fa-close'></span></a>
                                                                <?php endif; ?>
                                                            </td>
                                                        
                                                </tr>
                                                <?php


                                                  endforeach;
                                              
                                            ?>
                            
                          </tbody>
                        </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <?php require_once("modals/cash_des.php"); ?>
        </section><!-- /.content -->
  </div>

<script type="text/javascript">


<?php if(!empty($_GET['journal_entry'])): ?>


  $(document).ready(function(){
    $("#myModal").modal("show");
  });

  $('#myModal').modal({
    
    keyboard: true


  }); 

    
<?php else: ?>

  $(document).ready(function(){
    $("#myModal").modal("hide");
  });
<?php endif; ?>    


  $(function () {
        $('#ResultTable').DataTable({
            "scrollX": true
            // ,
            // dom: 'Bfrtip',
            //     buttons: [
            //         {
            //             extend:"excel",
            //             text:"<span class='fa fa-download'></span> Download as Excel File "
            //         }
            //         ],

        });
      });





</script>


<?php
  
  
  addFoot();
?>