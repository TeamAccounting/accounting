<?php
	require_once('support/config.php');
	if(loggedId()){
		addHead('Trial Balance');

		require_once("templates/sidebar.php");
    require_once("templates/navbar.php");
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }
  // var_dump($_POST);

  // if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
  //     $fromdate = $_POST['from_date'];
  //     $todate = $_POST['to_date'];

      if(isset($_POST['year'])){
          $year_selected = $_POST['year'];

        }


	// }
?>



<div class="content-wrapper">
  <section class="content-header">
    <h2> Trial Balance</h2>
    <?php
    Alert();
   
    $select_year=$connection->myQuery("Select year,id From available_balance Where is_deleted=0");
    $journalstable=$connection->myQuery("Select * From journals where is_archived != 1");
    if(isset($_POST['year'])){
      $year = $connection->myQuery("Select journal_date From journals where year(journal_date)=$year_selected")->fetch(PDO::FETCH_ASSOC);
      echo "<h3 align='center'><strong>".$year_selected." Trial Balance</strong></h3>";
    }
  ?>

    	<div class="box">
          <div class="box-body">
            <form action='trial_balance.php' method='POST'>
              <div class="form-group">
                <label class="col-lg-2 control-label" for='year'>Select Year</label>
                <div class="col-lg-2">
                  <select class='form-control' name="year" id="year" required>
                    <?php echo makeOptions($select_year) ?>
                  </select>
                </div>
                <button type='submit' class='btn btn-primary'>Make Trial Balance</button>
              </div>
            </form>
          </div> 
            <div class="box-body">
                  <table id="table" class="table responsive-table table-bordered table-striped">
                    <thead>
                       <tr class="tableheader">
                        <th><center>ACCOUNT</center></th>
                        <th><center>DEBIT</center></th>
                        <th><center>CREDIT</center></th>
                      </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="tableheader"> -->
                      <!-- <tr class="tableheader"> -->
          <?php
            $ledger_array = array();
          
            if(isset($_POST['year'])){
              
              // if($fromdate<=$todate){
              //   $journalentries = $connection -> myQuery("Select journal_entry_no, date_of_entry from journal_entries where journal_id between $fromdate and $todate");
              // }else{
              //   $journalentries = $connection -> myQuery("Select journal_entry_no, date_of_entry from journal_entries where journal_id between $todate and $fromdate");
              // }
              // var_dump($year);
              // die;
            $journalentries = $connection -> myQuery("Select journal_entry_no, date_of_entry from journal_entries where year(date_of_entry)=$year_selected");
            $balance= $connection -> myQuery("Select amount from available_balance where year=$year_selected")->fetch(PDO::FETCH_ASSOC);
              while($row=$journalentries->fetch(PDO::FETCH_ASSOC)){
                $journal_entry_no = $row['journal_entry_no'];
                $journal_date = $row['date_of_entry'];
                $journaldetails = $connection -> myQuery("Select * from journal_details INNER JOIN accounts on accounts.acc_id = journal_details.account_id
                INNER JOIN account_types on accounts.type = account_types.acc_types_id where journal_entry_no = $journal_entry_no");
                while($rows = $journaldetails->fetch(PDO::FETCH_ASSOC)){
                  $newaccount = $rows['account_name'];
                  if(array_key_exists($newaccount, $ledger_array)){
                    if($rows['is_debit']==1){
                      $previous = count($ledger_array[$newaccount])-1;
                      if($rows['is_debit']==$rows['inc_when_debit']){
                        $ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$rows['amount'],$rows['desc']);
                      }else{
                        $ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$rows['amount'],$rows['desc']);
                      }
                    }   
                    // else{
                    //   $previous = count($ledger_array[$newaccount])-1;
                    //   if($rows['is_debit']==$rows['inc_when_debit']){
                    //     $ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],$ledger_array[$newaccount][$previous][4] + $rows['amount'],$rows['desc']);
                    //   }else{
                    //     $ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],$ledger_array[$newaccount][$previous][4] - $rows['amount'],$rows['desc']);
                    //   }
                    // }
                  }else{
                    
                    if($rows['is_debit']==1){
                      if($rows['is_debit']==$rows['inc_when_debit']){
                        $ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$rows['amount'],$rows['desc']);
                      }else{
                        $ledger_array[$newaccount][] = array($journal_date,$rows['amount'],"-", $rows['is_debit'],$rows['amount'],$rows['desc']);
                      }
                    }
                    // else{
                    //   if($rows['is_debit']==$rows['inc_when_debit']){
                    //     $ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],+$rows['amount'],$rows['desc']);
                    //   }else{
                    //     $ledger_array[$newaccount][] = array($journal_date,"-",$rows['amount'], $rows['is_debit'],-$rows['amount'],$rows['desc']);
                    //   }
                    // }
                  
                  }
                }
              }
              $debitSum = 0;
              $creditSum = 0;
              $totbal=$balance['amount'];
              // echo "<pre>";
              // var_dump($ledger_array);
              // echo "</pre>";
                // die;
              echo "<tr><td><b>Available Balance</td><td></td><td><center><b>".$balance['amount']."</b></td></tr>";
              foreach($ledger_array as $account_title => $content){
                // print_r($content);

                $row = 0;
                for($row = 0; $row<=count($content)-1;$row++){
                  if($row==0){
                    echo "<tr >";
                    echo "<td><b>".$account_title."</b></td></tr>";
                    echo "<tr><td>".$content[$row][5]."</td>";
                    if (floatval($content[$row][3]) == 0 && floatval($content[$row][4] == 0))  {
                      echo "<td ><center>-</center></td>";
                      echo "<td ><center>-</center></td>";
                      
                      
                      
                    }elseif(floatval($content[$row][3]) == 0 && floatval($content[$row][2] != 0)){
                        echo "<td ><center>-</center></td>";
                        echo "<td ><center><strong>".abs(floatval($content[$row][4]))."</strong></center></td>"; 
                        // $creditSum += abs(floatval($content[$row][4]));
                    }else
                      {
                        echo "<td ><center><strong>".abs(floatval($content[$row][4]))."</strong></center></td>";
                        $totbal=$totbal-floatval($content[$row][4]);
                        echo "<td ><b><center>".$totbal."</center></td></center>";
                        $debitSum += abs(floatval($content[$row][4]));

                      }
                  
                    echo "</tr>";
                    
                  
                  
                  } else {
                    echo "<tr><td>".$content[$row-1][5]."</td>";
                    if (floatval($content[$row-1][3]) == 0 && floatval($content[$row-1][4] == 0))  {
                      echo "<td ><center>-</center></td>";
                      echo "<td ><center>-</center></td>";
                      
                      
                      
                    }elseif(floatval($content[$row-1][3]) == 0 && floatval($content[$row-1][2] != 0)){
                        echo "<td ><center>-</center></td>";
                        echo "<td ><center><strong>".abs(floatval($content[$row-1][4]))."</strong></td>"; 
                        // $creditSum += abs(floatval($content[$row-1][4]));
                    }else
                      {
                        echo "<td ><center><strong>".abs(floatval($content[$row-1][4]))."</strong></td>";
                        $totbal=$totbal-floatval($content[$row-1][4]); 
                        echo "<td ><b><center>".$totbal."</center></td>";
                        $debitSum += abs(floatval($content[$row-1][4]));

                      }
                    
                    echo "</tr>";
                    
                  }
                  }
                }
                   
                echo "<tr >";
                echo "<td '><strong><center>TOTAL</strong></td>";
                //td
                echo "<td ><center><strong>" . $debitSum . "</strong></td>";
                echo "<td ><center><strong>". $totbal . "</strong></td>";
                echo "</tr>";
            }
            
          ?>
                    </tbody>
                  </table>
                <div id='baldiv'>
                <?php if(!empty($row)){
                                       echo "<br><span style='font-size:20px;''><b><center>Available Balance for ".($year_selected+1).": ".$totbal."</center></b></span>";
                                       $cur_year= $connection -> myQuery("Select year from available_balance where year=$year_selected+1")->fetch(PDO::FETCH_ASSOC);
                                        if($totbal<0){?>
                                            </div>
                                            <br><br><div class="form-group">
                                            <label class="col-lg-3 control-label" for='add'><b>Additional Cash/Capital:</label>
                                            <div class="col-lg-3">
                                              <input type='number' name='addcash' id='addcash' min='<?php echo abs($totbal);?>' style='text-align:right;'></input>
                                            </div>
                                              <button class='btn btn-primary btn-sm' onclick="Comp()">Compute Balance</button>
                                              <form action="save_trial_balance.php" method="POST" id="submitform">
                                              <input type='hidden' name='add' id='add'></input>
                                              <input type="hidden" id="nxtyear" value="<?php echo $cur_year['year'];?>"></input>
                                              <input type="hidden" id="totbal" value="<?php echo $totbal;?>"></input>
                                              <input type='hidden' id='totbal1' name='totbal'></input>
                                              <input type="hidden" name="year1" id='year1' value="<?php echo ($year_selected+1);?>"></input>
                                              <br><br><center><button type='button' id='save' name='save' class='btn btn-success' onclick="return Check()" disabled>Save</button></center>
                                    <?php }else{
                                              if(empty($cur_year['year'])){?>
                                              <form action="save_trial_balance.php" method="POST">
                                            <input type='hidden' name='add' id='add' value=''></input>
                                            <input type='hidden' name='bal' id='bal' value='<?php echo $totbal;?>'></input>
                                            <input type='hidden' name='year' id='year' value='<?php echo ($year_selected+1);?>'></input>
                                            <br><center><button type='submit' id='save' name='save' class='btn btn-success' onclick="return confirm('<?php echo "This will create a balance for the year ".($year_selected+1).". Are you sure?"?>');">Save</button></center>
                                          <?php }else{?>
                                          <form action="save_trial_balance.php" method="POST">
                                           <input type='hidden' name='add' id='add' value=''></input>
                                            <input type='hidden' name='bal' id='bal' value='<?php echo $totbal;?>'></input>
                                            <input type='hidden' name='year' id='year' value='<?php echo ($year_selected+1);?>'></input>
                                            <br><center><button type='submit' id='save' name='save' class='btn btn-success' onclick="return confirm('<?php echo "This will replace current balance for the year ".($year_selected+1).". Are you sure?"?>');">Save</button></center>
                                              <?php }
                                            }
                                      } ?> 
                </form>
                <!-- /.box-body -->
    	</div>
  	</section>  
</div>
 <script type="text/javascript">
    function Comp(){
      var addcash = document.getElementById("addcash").value;
      var totbal = document.getElementById("totbal").value;
      var year=document.getElementById("year1").value;
      var amount=parseInt(totbal)+parseInt(addcash);
      if(addcash==''){
        alert('Please input additional cash / capital.');
        $('#save').attr('disabled','disabled');
        return;
      }
      else{
      document.getElementById("baldiv").innerHTML = "<br><span style='font-size:20px;''><b><center>Available Balance for "+year+": "+amount+"</center></b></span>"
      document.getElementById("totbal1").value=amount;
      document.getElementById("add").value=addcash;
      if(amount<0){
        $('#save').attr('disabled','disabled');
      }else{
        $('#save').removeAttr('disabled');
      }
    }
  }
    function Check(){
      var totbal1 = document.getElementById("totbal1").value;
       var nxtyear = document.getElementById("nxtyear").value;
        if(nxtyear==''){
          if (confirm("This will create a balance for the year "+nxtyear+". Are you sure?") == true) {
            alert('true');
          } else {
            alert('false');
          }
        }else{
          if (confirm("This will replace current balance for the year "+nxtyear+". Are you sure?") == true) {
            document.getElementById("submitform").submit()
            } else {
            return false;
          }
        }
      }
    </script>

<?php
	addFoot();
?>



