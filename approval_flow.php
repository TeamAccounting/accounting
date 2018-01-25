<?php
  require_once('support/config.php');
  if(loggedId()){
    addHead('Approval Flow');
    require_once("templates/sidebar.php");
    require_once("templates/navbar.php");
  }else{
    redirect('index.php');
    setAlert('Please log in to continue','danger');
  }
  
    $data=$connection->myQuery("SELECT ru.id,ru.user_id,CONCAT(u.full_name,' (',ut.name,')') as user FROM approval_flow ru

     LEFT JOIN users u ON ru.user_id=u.user_id

     INNER JOIN user_type ut ON u.user_type=ut.id

     ORDER BY ru.id ASC");


    $users=$connection->myQuery("SELECT u.user_id, CONCAT(u.full_name,' (',ut.name,')') as user FROM users u
      INNER JOIN user_type ut ON u.user_type=ut.id
     WHERE u.is_deleted='0' AND u.user_id NOT IN (SELECT user_id FROM approval_flow)")->fetchAll(PDO::FETCH_ASSOC);


   $finance_approver= $connection->myQuery("SELECT * FROM finance_approver")->fetch(PDO::FETCH_ASSOC);

   echo $finance_approver['user_id'];
	// makeHead("Approval Flow");
?>

 <style type="text/css">
        body.dragging, body.dragging * {
          cursor: move !important;
        }

        .dragged {
          position: absolute;
          opacity: 0.5;
          z-index: 2000;
        }
       .sortable-table tbody tr {
          cursor: pointer; }
        /* line 96, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
        .sortable-table tr.placeholder {
          display: block;
          background: #337ab7;
          position: relative;
          margin: 0;
          padding: 0;
          /*border: none;*/ }
          /* line 103, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
          .sortable-table tr.placeholder:before {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-left-color: #337ab7;
            margin-top: -5px;
            left: -5px;
            border-right: none; }
          
</style>

 	<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Approval Flow
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
                        <form method='post' action='save_approval_flow.php' class='form-horizontal'>
                            <div class='form-group'>
                            <label class='col-md-2'>Add User to process</label>
                            <div class='col-xs-12 col-md-8'>
                                <select class='select2 form-control cbo' name='user_id' required="" data-placeholder="Select user to be added.">
                                    <?php 
                                        echo makeOptions($users);
                                    ?>
                                </select>
                            </div>
                            <div class='col-sm-12 col-md-2' style=''>
                                <button type='submit' class='btn btn-brand'><span class='fa fa-plus'></span> Add User</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <form method="post" action="edit_process.php">
                        <div class='panel panel-info'>
                        <table class="table sortable-table table-hover ">
                            <thead>
                                <tr>
                                <th class='text-center' style='max-width: 100px;width: 100px'>Step</th>
                                  <th class='text-center'>User</th>
                                  <th class='text-center' style='max-width: 100px;width: 100px'>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            
                            <?php
                            $ctr = 0;
                                foreach ($data as $key => $row):
                            ?>
                                <tr>
                                    <th class='text-center'>
                                    <?php
                                    $ctr++;
                                    echo $ctr;
                                    ?>
                                    </th>

                                    <td>
                                    <input type="hidden" name="user_id[]" value="<?php echo $row['user_id']?>">
                                    <?php echo htmlspecialchars($row['user']) ?>
                                    </td>
                                    <td class='text-center'>
                                        <a href='remove_flow.php?id=<?php echo $row['id']?>' class='btn btn-sm btn-danger' onclick='return confirm("Remove this user from the process.")'><span class='fa fa-close'></span></a>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                            </tbody>
                            <tfoot>

                                <td colspan='3' style="text-align: right"><button class="btn btn-brand" >Save Process</button> 
                                <!-- <a href="process.php" class="btn btn-default" > Cancel</a></td> -->

                              
                            </tfoot>
                        </table>
                        </div>
                    </form>
                    
                    </div>
                </div>
            </div>
            
            <div class='box'>
               <div class='box-body'>

                    <div class='col-xs-12 col-md-8 col-md-offset-2'>
                    <div class='row'>
                         <form method='post' action='save_finance_approver.php' class='form-horizontal'>
                                        <div class='form-group'>
                                        <label class='col-md-3'>Finance Approver/Final Approver</label>
                                        <div class='col-xs-12 col-md-6'>
                                            <select class='form-control cbo' name='finance_id' required="" data-placeholder="Select finance approver." <?php echo !(empty($finance_approver))?"data-selected='".$finance_approver['user_id']."'":NULL ?> required>


                                           
                                        
                                                <?php 
                                                    echo makeOptions($users);
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-sm-12 col-md-3' style=''>
                                            <button type='submit' class='btn btn-brand'><span class='fa fa-'></span> Save</button>
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
