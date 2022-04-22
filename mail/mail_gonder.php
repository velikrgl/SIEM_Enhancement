<?php
require("class.phpmailer.php");
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";

$mail->Username = "info.gpalert@gmail.com"; // Mail adresi
$mail->Password = "Aa12345."; // Parola
$mail->SetFrom("info.gpalert@gmail.com", "GPALERT"); // Mail adresi

$name = "Admin";
$email = "admin@admin.com.tr";
$subject ="GPALERT INFORMATION";
$message = "Please check for connections. There is/are some error !";

$mail->AddAddress("velikrgl@yahoo.com"); // Gönderilecek kişi

$mail->Subject = "GPCONNECTION ALERT";
$mail->Body = "$name<br />$email<br />$subject<br />$message";

if(!$mail->Send()){
                echo "Mailer Error: ".$mail->ErrorInfo;
}
?>