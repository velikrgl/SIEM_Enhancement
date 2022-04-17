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

} else if($_GET['db'] == "listDatabase") {
 
    if(isset($_GET['filter']) && $_GET['filter'] == 1) {  $fQuery = " blackOrWhite = '1' "; }
    if(isset($_GET['filter']) && $_GET['filter'] == 2) {  $fQuery = " blackOrWhite = '0' "; }

$table = 'connections';
$getLink = "generalListDatabase";

// Table's primary key
$primaryKey = 'id';



$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'blackOrWhite', 'dt' => 1,
    'formatter' => function( $d, $row ) {
        if($d == 1) $mes ='<span class="text-success">White List</span>';
        else  $mes ='<span class="text-danger">Black List</span>';

        return $mes;
    }

    ),
    array( 'db' => 'connection_name', 'dt' => 2 ),
    array( 'db' => 'api_query', 'dt' => 3 ),
    array( 'db' => 'fetch_time', 'dt' => 4 ),
    array( 'db' => 'status', 'dt' => 5,

    'formatter' => function( $d, $row ) {
    
        if($d == 1) $mes ='<span class="text-success">Active</span>';
        else  $mes ='<span class="text-danger">Passive</span>';
        return $mes;
    }
    ),
);

} else if($_GET['db'] == "accounts") {

    $table = 'accounts';
    $getLink = "accountsAddMember";
    
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