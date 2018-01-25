 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
            <div class="modal-dialog modal-lg" role="document" style="width: 80%">
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                  <h4 class="modal-title" id="myModalLabel">

                    <table style="width:100%" border=0>
                      <tr>
                     
                        <td><b>Date Entry:</b> <?php echo $journal_date['journal_date']; ?></td>
                       
                      </tr>
                      <tr>
                     
                        <td><b>Month Year:</b> <?php

                        $date1=date_create($journal_date['journal_date']);
                                                                 
                                            
                            echo $date1->format("F Y"); ?></td>
                       
                      </tr>
                       <tr>
                     
                        <td><b>Description:</b> <?php echo $journal_date['description']; ?></td>
                       
                      </tr>
                   
                    </table>
                   </h4>

                </div>

                <div class="modal-body"> 
                  

                  
                  <div class='panel-body ' >
                  <table class='table table-bordered table-condensed table-hover ' id='ResultTable1'>
                
                    
                      <thead>
                        <tr>
                          <th class='text-center'>Date of Entry</th>
                          <th class='text-center'>Account Title</th>

                          <!-- <th class='text-center'>Debit</th> -->
                          <th class='text-center'>Credit</th>
                          <th class='text-center'>Reason</th>

                        </tr>
                      </thead>
                      <tbody> 
                      <?php foreach ($journal_entry as $rowss): ?>
                         <tr>
                          <td>
                             <?php echo $rowss['date_of_entry']; ?>
                          </td>
                          <td>
                             <?php echo $rowss['account_name']; ?>
                          </td>
                          <?php if($rowss['is_debit'] == '0'): ?>
                             <td>
                               <?php echo $rowss['amount']; ?>
                            </td>
                        
                             <td>
                               <?php echo $rowss['reason']; ?>
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                
                    </table>
                    <div class="modal-footer">
                    <?php if($_GET['type'] == "request"): ?>
                       <a class="btn btn-default" href='pending_request.php' class='btn btn-sm btn-danger'>Close</a>
                    <?php else: ?>
                      <a class="btn btn-default" href='cash_approval.php' class='btn btn-sm btn-danger'>Close</a>
                    <?php endif; ?>
                    </div>

                  </div>

                </div>
              </div>
            </div>

          </div>