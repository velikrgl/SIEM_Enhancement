<?php

if(isset($_POST["conn_id"]))
{
    $output ='';
    $conn = new mysqli('localhost', 'root', '', 'gradproj');
    $sql = "SELECT * FROM  connections WHERE id = '".$_POST["conn_id"]."' "; 

    $result = $conn->query($sql);

    $row=mysqli_fetch_array($result);

    echo json_decode($row);




}


?> 