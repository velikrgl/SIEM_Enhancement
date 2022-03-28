<?php
$conn = new mysqli('localhost','root','','gradproj');


if(isset($_POST['add_black_database']))
{
    $con_name= $_POST['conName'];
    $url_external=$_POST['url_external'];
    $refresh_rate=$_POST['refresh_rate'];
    $usercrated="velikrgl";

    $query = "INSERT INTO connections (con_name,url_external,refresh_rate) VALUES ('$con_name','$url_external','$refresh_rate','','','$usercrated','','1')";
    $query_run =mysqli_query($conn,$query);

}
?>