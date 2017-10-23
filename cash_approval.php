<?php
    require_once("support/config.php");

?>

<?php

?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customer Changes
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
                                                <th class='text-center'>Customer's Name</th>
                                                <th class='text-center'>Phone Number</th>
                                                <th class='text-center'>Email Address</th>
                                                <th class='text-center'>Ratings</th>
                                                <th class='text-center'>Type</th>
                                                <th class='text-center'>Creator</th>
                                                <th class='text-center'>Description</th>
                                                <th class='text-center'>Modified By</th>
                              <th class='text-center' style='min-width:100px'>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                                                $org=$connection->myQuery("SELECT * FROM cash_request")->fetch(PDO::FETCH_ASSOC);

                                              
                                                $approver=$connection->myQuery("SELECT * from approval_flow ORDER BY id asc limit ".$org['num_of_approver'].",1");
                                                
                                                // echo $approver['id'];
                                                 foreach ($approver as $app_id):

                                                  echo $approver_id = $app_id['user_id']."wew";
                                                  endforeach;


                                                // $org=$connection->myQuery("SELECT * FROM cash_request WHERE ")->fetch(PDO::FETCH_ASSOC);
                                                if ($approver_id == $_SESSION[APPNAME]['UserId']):
                                                foreach ($organizations as $row):
                                            ?>
                              <tr>
                                                        <!-- <td>
                                                        <input type="checkbox" name="select_org" value="<?php echo $organization["id"];?>" />
                                                        </td> -->
                                                       
                                                            <td>
                                                                <a class='btn btn-sm btn-brand' href='view_customer_changes.php?id=<?php echo $value;?>'><span class='fa fa-search'></span></a>
                                                                <a class='btn btn-sm btn-brand' href='approve_changes.php?id=<?php echo $value;?>&type=customers'><span class='fa fa-check'></span></a>
                                                                <a class='btn btn-sm btn-danger' href='reject_changes.php?id=<?php echo $value?>&type=customers' onclick='return confirm("Changes will be discarded.")'><span class='fa fa-close'></span></a>
                                                            </td>
                                                        
                                                </tr>
                                                <?php


                                                endforeach;
                                                endif;
                                            ?>
                            
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