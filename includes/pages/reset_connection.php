<?php 

if(isset($_POST["con_name"]))
{
    $output ='';
    $conn = new mysqli('localhost', 'root', '', 'gradproj');
    $sql = "SELECT * FROM  connections WHERE connection_name = '".$_POST["con_name"]."' "; 

    $result = $conn->query($sql);

    $output.='
    <div class="table-responsive">
        <table class"table table-bordered">';
        if ($result->num_rows > 0) {

            while ($rows = $result->fetch_assoc()) {
    
                 $output.='

                <tr>
                    <td width="30%"><label>ID :</label></td>
                    <td width="70%">'.$rows["id"].'</td>
                </tr>
                <tr>
                    <td width="30%"><label>Connection Name:</label></td>
                    <td width="70%">'.strtoupper($rows['connection_name']).'</td>
                 </tr>

                <tr>
                    <td width="30%"><label>Api Query:</label></td>
                    <td width="70%">'.$rows["api_query"].'</td>
                </tr>
                <tr>
                    <td width="30%"><label>Fetch Time:</label></td>
                    <td width="70%">'.$rows["fetch_time"].'</td>
                </tr>
                <tr>
                    <td width="30%"><label>BlackOrWhite:</label></td>
                    <td width="70%">'.$rows["blackOrWhite"].'</td>
                </tr>
                <tr>
                    <td width="30%"><label>CreatedTime:</label></td>
                    <td width="70%">'.$rows["createdTime"].'</td>
                </tr>

                <tr>
                    <td width="30%"><label>Created User:</label></td>
                    <td width="70%">'.$rows["userwhocreated"].'</td>
                 </tr>
                <tr>
                    <td width="30%"><label>Creation Reason:</label></td>
                    <td width="70%">'.$rows["creationReason"].'</td>
                </tr>
                <tr>
                    <td width="30%"><label>Status:</label></td>
                    <td width="70%">'.$rows["status"].'</td>
                </tr>

                 ';


            }
        }


$output .="</table></div>";
echo $output;

}
