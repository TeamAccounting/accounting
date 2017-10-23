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
  
    $data=$connection->myQuery("SELECT ru.id,ru.user_id,u.full_name as user FROM approval_flow ru LEFT JOIN users u ON ru.user_id=u.user_id ORDER BY ru.id ASC");
    $users=$connection->myQuery("SELECT u.user_id, u.full_name as user FROM users u WHERE u.user_id NOT IN (SELECT user_id FROM approval_flow)")->fetchAll(PDO::FETCH_ASSOC);
	// makeHead("Approval Flow");
?>


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
                        ?>
                        <form method='post' action='save_approval_flow.php' class='form-horizontal'>
                            <div class='form-group'>
                            <label class='col-md-2'>Add User to process</label>
                            <div class='col-xs-12 col-md-8'>
                                <select class='select2 form-control' name='user_id' required="" data-placeholder="Select user to be added.">
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
                    <form method="post" action="editprocess.php">
                        <div class='panel panel-info'>
                        <table class="table sortable-table table-hover ">
                            <thead>
                                <tr>
                                  <th class='text-center'>User</th>
                                  <th class='text-center' style='max-width: 50px;width: 50px'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($data as $key => $row):
                            ?>
                                <tr>
                                    <td>
                                    <input type="hidden" name="user_id[]" value="<?php echo $row['user_id']?>">
                                    <?php echo htmlspecialchars($row['user']) ?>
                                    </td>
                                    <td>
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
        </section><!-- /.content -->
  </div>
  <script type="text/javascript" src='js/jquery-sortable.js'></script>


<?php
  
  
  addFoot();
?>