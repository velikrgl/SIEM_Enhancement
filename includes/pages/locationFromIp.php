<?php
$ip = "81.8.19.15";
 
$ch = curl_init('http://ip-api.com/json/'.$ip.'?lang=en');                                                                     
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json'                                                                                
));
$result = curl_exec($ch);

$data = json_decode($result);
 
echo "Durum: ".$data->status;
echo " <br> ";
 
echo "Ülke:".$data->country;
echo " <br> ";
 
echo "Ülke Kodu:".$data->countryCode;
echo " <br> ";
 
echo "Şehir:".$data->regionName;
echo " <br> ";
 
echo "Posta Kodu:".$data->zip;
echo " <br> ";
 
echo "Saat Dilimi:".$data->timezone;
echo " <br> ";
 
echo "İnternet Provider:".$data->isp;
echo " <br> ";
 
echo "Firma Name:".$data->as;

?>