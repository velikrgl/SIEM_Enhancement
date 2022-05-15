<?php

include("includes/sec.php");  

if(isset($_GET['act']) and $_GET['act']== "delete") {

    if($_GET['db']== "accounts" and $_GET['id'] > 0){
         $query = dbQuery("DELETE FROM accounts where id = '".$_GET['id']."' ");
         $query = explode(":",$query);
         die($query[0]);
    }
}

if(isset($_GET['add']) and $_GET['add']== "uri") {
    $data = $_GET['uri'];
    $uriType = $_GET['uriType'];
    $conID = $_GET['conID'];
    $type = uriDataChech($data);
    $query = dbQuery("INSERT INTO db_status (ip_hash_url,info_type,blackorWhite,connectionID) VALUES ('$data','$type','$uriType','$conID')");
    $datas = $data;
    //$datas[1] = uriDataChech($data);

    die($datas);

}




include("includes/header.php");


    if(isset($_GET['page']) and $_GET['page'] != "") {
        if(file_exists("includes/pages/".$_GET['page'].".php")) include("includes/pages/".$_GET['page'].".php"); else include("includes/pages/noPage.php");
    } else {
     include("includes/pages/admin.php");
    }

include("includes/footer.php");

?>