<?php

function redirecLink($link){
    echo("<script>location.href = '$link';</script>");
}


function dbQuery($q){

     $dbh  = new PDO('mysql:dbname='.DB_DB.';charset=UTF8;host='.DB_HOST.';port='.DB_PORT,DB_USER,DB_PASS);
     $sql=$dbh->query($q);

     if($sql) return "ok:".$sql->fetch(PDO::FETCH_ASSOC); else return "hata :".$dbh->errorInfo()[2];
     $dbh =null;

}


function dbPrepare($q,$e){
     $dbh  = new PDO('mysql:dbname='.DB_DB.';charset=UTF8;host='.DB_HOST.';port='.DB_PORT,DB_USER,DB_PASS);
     $sql=$dbh->prepare($q);
     $sql->execute($e);
     $dbh =null;
     return $sql;
}
?>

function 