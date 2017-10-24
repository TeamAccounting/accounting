<?php
  require_once('support/config.php');
  if(loggedId()){
    addHead('Cash Approval');
    addNavBar();
    addSideBar();
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }
  
  if (!empty($_GET['journal_entry'])) {
    $id=$_GET['journal_entry'];
    $journal_entry=$connection->myQuery("SELECT a.account_name, jd.account_id, jd.amount, jd.is_debit, cr.request_by, cr.journal_entry_no, cr.journal_id, cr.date_of_entry, cr.description, cr.status_id,cr.approver_id,cr.total_amount, u.full_name FROM cash_request cr 
      INNER JOIN users u ON cr.request_by=u.user_id
      INNER JOIN journal_details jd ON cr.journal_entry_no=jd.journal_entry_no
      INNER JOIN accounts a ON jd.account_id=a.acc_id
      WHERE cr.journal_entry_no = ".$id)->fetch(PDO::FETCH_ASSOC);

      $date_modal=date_create($journal_entry['date_of_entry']);
      // var_dump($journal_entry);
      // die;

  } 
?>



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cash Approval
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">

            <div class='col-md-12'>
              <?php 
                Alert();
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
                                                <th class='text-center'>REQUEST BY</th>
                                                
                              <th class='text-center' style='min-width:100px'>ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php


                                                $approver_id = $_SESSION[APPNAME]['UserId'];

                                                $organizations=$connection->myQuery("SELECT cr.request_by, cr.journal_entry_no, cr.journal_id, cr.date_of_entry, cr.description, cr.status_id,cr.approver_id,cr.total_amount, u.full_name FROM cash_request cr INNER JOIN users u ON cr.request_by=u.user_id  WHERE cr.approver_id = ".$approver_id)->fetchAll(PDO::FETCH_ASSOC);
                                                 
                                          

                                                  foreach ($organizations as $row):
                                            ?>
                                                <tr>
                                                        
                                                        <td>
                                                          <?php echo htmlspecialchars($row['date_of_entry']); ?>
                                                        </td>
                                                        <td>
                                                         <?php 
                                                          $date=date_create($row['date_of_entry']);
                                                           
                                      
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
                                                          <?php echo htmlspecialchars($row['full_name']); ?>
                                                        </td>
                                                       
                                                            <td>
                                                                <a class='btn btn-sm btn-brand' href='cash_approval.php?journal_entry=<?php echo $row['journal_entry_no'] ;?>'><span class='fa fa-search'></span></a>
                                                                <a class='btn btn-sm btn-brand' href='approve_changes.php?id=<?php echo $value;?>&type=customers'><span class='fa fa-check'></span></a>
                                                                <a class='btn btn-sm btn-danger' href='reject_changes.php?id=<?php echo $value?>&type=customers' onclick='return confirm("Reject Request?.")'><span class='fa fa-close'></span></a>
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
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
      <div class="modal-dialog modal-lg" role="document" style="width: 80%">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="myModalLabel">

              <table style="width:100%" border=0>
                <tr>
                  <td><b>Date Entry:</b> <?php  echo $date_modal->format("F Y"); ?></td>
                 
                </tr>
             
              </table>
             </h4>

          </div>

          <div class="modal-body"> 
            

            
            <div class='panel-body ' >
            <table class='table table-bordered table-condensed table-hover ' id='ResultTable1'>
          
              
                <thead>
                  <tr>
                    <th class='text-center'>Account Title</th>
                    <th class='text-center'>Debit</th>
                    <th class='text-center'>Credit</th>
                   

                  </tr>
                </thead>
                <tbody> 
                   <tr>
                    <td>
                       <?php echo $journal_entry['account_name']; ?>
                    </td>
                     <td>
                       <?php echo $journal_entry['account_name']; ?>
                    </td>
                  </tr>
                </tbody>
          
              </table>
              <div class="modal-footer">

                <a class="btn btn-default" href='cash_approval.php' class='btn btn-sm btn-danger'>Close</a>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>
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