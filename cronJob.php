<?php
date_default_timezone_set('Europe/Istanbul');
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', '3306' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', 'PE1iYa34WsoC3S8W' );
define( 'DB_DB', 'gradproj' );


$dbh  = new PDO('mysql:dbname='.DB_DB.';charset=UTF8;host='.DB_HOST.';port='.DB_PORT,DB_USER,DB_PASS);

include("includes/function.php");

$query = dbQuery("INSERT INTO db_status (ip_hash_url,info_type,blackorWhite,connectionID) VALUES (1,1,1,1)");

die($query);

?>