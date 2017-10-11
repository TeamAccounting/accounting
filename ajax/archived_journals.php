<?php
	require_once('../support/config.php');
	if(!loggedId()){
		redirect('index.php');
		setAlert('Please log in to continue','danger');
	}

$primaryKey ='journal_id';
$index=-1;

$columns = array(
array( 'db' => 'journal_id','dt' => ++$index,'formatter'=>function($d,$row)
{
	return htmlspecialchars($d);
} ),
array( 'db' => 'journal_date','dt' => ++$index ,'formatter'=>function($d,$row)
{
    $date=date_create($d);
    return htmlspecialchars($date->format("m-d-Y"));
}),
array( 'db' => 'journal_date','dt' => ++$index ,'formatter'=>function($d,$row)
{
    $date=date_create($d);
    return htmlspecialchars($date->format("F Y"));
}),
array( 'db' => 'description','dt' => ++$index,'formatter'=>function($d,$row)
{
	return htmlspecialchars($d);
} ),



array(
        'db'        => 'journal_id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
                //if loan status = approved but not process
                // another action buttons
                // if($row['approval_status']=="Approved-Undone"):
                //     $action_buttons.="<a class='btn btn-sm btn-success btn-flat' title='Proceeds' href='frm_loan_application.php?tab=2&id={$row['loaner_id']}&u={$row['loan_code']}'><span class='fa fa-arrow-right'></span></a>&nbsp;";
                // else:
                //     $action_buttons.="<a class=' btn btn-sm btn-success btn-flat' title='View Details' href='forApprovalDetails.php?id={$d}'><span class='fa fa-eye'></span></a>&nbsp";
                //     $action_buttons.="<button class='btn btn-sm btn-danger btn-flat'  title='Reject Loan Application' onclick='reject(\"{$row['loan_code']}\")'><span  class='fa fa-close'></span></button>&nbsp;";
                // endif;
          	$action_buttons.=" <button type='submit' class='btn btn-success' id='btn-view' data-toggle='tooltip' data-placement='top' title='Open Journal' onclick='redirect({$d});' name='btnview'><i class='fa fa-eye'> </i></button>";

			

			$action_buttons.="<button type='submit' class='btn btn-warning' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Archive this journal'  onclick='archive({$d});'><i class='fa fa-file-archive-o'> </i></button>";
                //reject(\"{$row['id']}\")   --------- forApprovalDetails.php?id={$d}
            return $action_buttons;


        }
    ),
	);
	require( '../support/ssp.class.php' );


		$limit = SSP::limit( $_GET, $columns );
$order = SSP::order( $_GET, $columns );

$where = SSP::filter( $_GET, $columns, $bindings );
$whereAll="";
$whereResult="";

$filter_sql="";
$whereAll=" is_archived='1'" ;
$whereAll.=$filter_sql;

function jp_bind($bindings)
{
    $return_array=array();
    if ( is_array( $bindings ) ) 
    {
        for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) 
        {
            //$binding = $bindings[$i];
            // $stmt->bindValueb   	qA@( $binding['key'], $binding['val'], $binding['type'] );
            $return_array[$bindings[$i]['key']]=$bindings[$i]['val'];
        }
    }
    return $return_array;
}
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;
$bindings=jp_bind($bindings);
$complete_query="SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", SSP::pluck($columns, 'db'))."`
             FROM `vw_journals` {$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$connection->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$connection->myQuery("SELECT FOUND_ROWS();")->fetchColumn();




$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsFiltered;
$json['recordsFiltered']=$recordsFiltered;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);

// $resTotalLength = SSP::sql_exec( $db, $bindings,
//             "SELECT COUNT(`{$primaryKey}`)
//              FROM   `$table` ".
//             $whereAllSql
//         );

die;

?>