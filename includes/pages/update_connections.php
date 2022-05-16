<?php
$conn_id_test=  $_GET["conn_id"];

if(isset($conn_id_test))
{
    $output ='';
    $conn = new mysqli('localhost', 'root', '', 'gradproj');
    $sql = "SELECT * FROM  connections WHERE id = $conn_id_test "; 

    $result = $conn->query($sql);

    $row=mysqli_fetch_array($result);

   $value="";
   $value_second="";
   if($row['blackOrWhite']==1){
    $value="selected";
    
   }else{
      $value_second="selected";
   }

   $radio="";
   $radio_second="";
   if($row['status']==1){
    $radio="checked";
    
   }else{
      $radio_second="checked";
   }

$response ="";

    $response="<form method='post' id='insert_form'>";
    $response.="<label>Connection Name</label>";
    $response.="<input type='text' name='conn-name' id='Mconn_name' value='".$row['connection_name']."' class='form-control' /><br />";
    $response.="<label>Api Query</label>";
    $response.="<input type='text' name='api-query' id='api-query'   value='".$row['api_query']."' class='form-control' /><br />";
    $response.="<label>Fetch Time</label>";
    $response.="<input type='text' name='fetch_time' id='fetch_time'  value='".$row['fetch_time']."' class='form-control' /><br />";
    $response.="<label>BlackOrWhite</label>";
    $response.="<select name='blackorwhite' id='blackorwhite' class='form-control'>";
    $response.="<option $value  value='Black'>Black</option>";
    $response.="<option $value_second value='White'>White</option>";
    $response.="</select><br />";
    $response.="<div class='form-check form-check-inline'>";
    $response.="<label>Status:</label>";
    $response.="<input class='form-check-input' type='radio' name='inlineRadioOptions' $radio id='inlineRadioOptions' value='status-on' checked />";
    $response.="<label class='form-check-label' for='inlineRadio1'>ON</label>";
    $response.="<input class='form-check-input' type='radio' name='inlineRadioOptions' $radio_second id='inlineRadioOptions' value='status-off' />";
    $response.="<label class='form-check-label' for='inlineRadio2'>OFF</label>";
    $response.="</div></div><br />";
    $response.="<input type='hidden' name='conn_id' id='conn_id' />";
    $response.="<input type='submit' name='insert' id='insert' value='Update' class='btn btn-success' />";
    $response.="</form>";

 echo $response;

}
//Update part need to be fixed
if(isset($_POST['insert'])){

    $connection_name = $_POST['conn-name'];
    $api =$_POST['api-query'];
    $fetch_time=$_POST['fetch_time'];
    $borwhite= $_POST['blackorwhite'];
    $status =$_POST['inlineRadioOptions'];

   $sql= "UPDATE  connections  SET  connection_name ='$connection_name', api_query ='$api', fetch_time ='$fetch_time', blackOrWhite ='$borwhite', '', userwhocreated ='', creationReason ='', status ='$status' WHERE id='$conn_id_test' ";
   $result = $conn->query($sql);
}
