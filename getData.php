<?php  include("includes/sec.php");

$fQuery = "";

$dbDetails = array(
    'host' => DB_HOST,
    'user' => DB_USER,
    'pass' => DB_PASS,
    //'db'   => 'jtable'
    'db'   => DB_DB
);



if($_GET['db'] == "reports") {
 
    if(isset($_GET['filter']) && $_GET['filter'] == 2) {  $fQuery = " scanned_type = '2' "; }
    else if(isset($_GET['filter']) && $_GET['filter'] == 3) { $fQuery = " scanned_type = '3' "; }
    else if(isset($_GET['filter']) && $_GET['filter'] == 4) {  $fQuery = ""; }
    else { $fQuery = " scanned_type = '1' ";}

$table = 'scanned_db';
$getLink = "reports";

// Table's primary key
$primaryKey = 'id';



$columns = array(
    array( 'db' => 'scanned_source', 'dt' => 0 ),
    array( 'db' => 'scanned_time', 'dt' => 1 ),
    array( 'db' => 'status', 'dt' => 2 ),
    array( 'db' => 'which_api_src', 'dt' => 3 ),
    array( 'db' => 'blocked', 'dt' => 4 ),
    array( 'db' => 'country', 'dt' => 5 ),
    array( 'db' => 'city', 'dt' => 6 ),
);

} else if($_GET['db'] == "accounts") {

    $table = 'accounts';
    $getLink = "accounts";
    
    // Table's primary key
    $primaryKey = 'id';
    
    
    
    $columns = array(
        array( 'db' => 'username', 'dt' => 0 ),
        array( 'db' => 'name', 'dt' => 1 ),
        array( 'db' => 'surname', 'dt' => 2 ),
        array( 'db' => 'email', 'dt' => 3 ),
        array(
            'db'        => 'authorization',
            'dt'        => 4,
            'formatter' => function( $d, $row ) {
    
                if($d == 2) $mes ='<span class="text-danger">Admin</span>';
                else if($d == 1) $mes ='<span class="text-success">mod</span>';
                else if($d == 0) $mes ='<span class="text-dark">member</span>';
    
                return $mes;
            }
        ),
        array(
            'db'        => '',
            'dt'        => 5,
            'dbs' => 'action'
        )
    );
    
    }   
// Include SQL query processing class
require 'ssp.class.php';

       echo json_encode(
        SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns,$getLink,$fQuery)
    );
 

 ?>