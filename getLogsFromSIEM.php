<?php
//curl -u admin:MyStrongPassword -H "Accept: application/json" -X GET "http://192.168.15.132:9000/api/users"


$host = 'http://192.168.15.132:9000/api/search/universal/relative?query=source%3ADESKTOP-60J67AC&range=29604800&decorate=true';
$user_name = 'admin';
$password = 'MyStrongPassword';
$ch = curl_init($host);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode("$user_name:$password")
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch); //value that we get from query 

if (curl_errno($ch)) {
    // throw the an Exception.
    throw new Exception(curl_error($ch));
}
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


$json_string = $response;

$json_array  = json_decode($json_string, true);
$size_of_array = count(($json_array));
$data_from_logs = array();


//print("<pre>".print_r($json_array,true)."</pre>");

$conn = new mysqli('localhost', 'root', '', 'gradproj');



for ($i = 0; $i < $size_of_array; $i++) {

    $logtid = $json_array['messages'][$i]['message']['gl2_message_id'];
    $logtime = $json_array['messages'][$i]['message']['timestamp'];

    //Get ip adresses
    $src_ip = $json_array['messages'][$i]['message']['src-ip'];
    $hop_ip = $json_array['messages'][$i]['message']['dst-ip'];
    $destination_ip = $json_array['messages'][$i]['message']['gl2_remote_ip'];

    //Get ports 
    $src_port = $json_array['messages'][$i]['message']['src-port'];
    $hop_port = $json_array['messages'][$i]['message']['dst-port'];
    $destination_port = $json_array['messages'][$i]['message']['gl2_remote_port'];

    $action = $json_array['messages'][$i]['message']['action']; //ALLOW OR BLOCK
    $protocol = $json_array['messages'][$i]['message']['protocol']; //TCP,UDP,HTTP


    $data_from_logs = array(
        'gl2_message_id' => $logtid, 'timestamp' => $logtime, 'src-ip' => $src_ip, 'dst-ip' => $hop_ip, 'gl2_remote_ip' => $destination_ip, 'src-port' => $src_port, 'dst-port' => $hop_port, 'gl2_remote_port' => $destination_port, 'action' => $action, 'protocol' => $protocol
    );

    $sql = "INSERT INTO siem_logs (log_id, log_time, remote_ip ,remote_port,hop_ip,hop_port,source_ip,source_port,action,protocol )
     VALUES ('$logtid','$logtime','$destination_ip','$destination_port','$hop_ip','$hop_port','$src_ip','$src_port','$action','$protocol');";

    $result = $conn->query($sql);
    
}

//echo $json_array['messages']['0']['message']['src-ip'];
