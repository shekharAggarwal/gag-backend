<?php

// Pear Mail Library
require_once "Mail.php";

if(isset($_POST['to']) && isset($_POST['body']) && isset($_POST['req-name']) && isset($_POST['req-email']) && isset($_POST['req-password'])){
    
$from = '<service-email>';
$to = $_POST['to'];
$subject = 'URDrive Response';
$content = "text/html";
$body = $_POST['body'];

$message = '<html><body>';
$message .= '<strong><h2>Hi '.strip_tags($_POST['req-name']).',</h2></strong>';
$message .= '<p>Congratulations! You&apos;re now part of a community your request is accepted. </p>
<strong><p>Please login with given below.</p></strong>';
$message .= '<img src="myinvented.com/urdriver/driver_license/download.png" height="42" width="42" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
$message .= "<tr><td><strong>Username:</strong> </td><td>" . strip_tags($_POST['req-email']) . "</td></tr>";
$message .= "<tr><td><strong>Password:</strong> </td><td>" . strip_tags($_POST['req-password']) . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject,
    'Content-Type'=> $content
);

$smtp = Mail::factory('smtp', array(
        'host' => 'mail-host',
        'port' => '25',
        'auth' => true,
        'username' => 'service-mail',
        'password' => 'password'
    ));

$mail = $smtp->send($to, $headers, $message);

if (PEAR::isError($mail)) {
    echo json_encode('<p>' . $mail->getMessage() . '</p>');
} else {
    echo json_encode("ok");
}
}else{
    echo json_encode("Required parameters (to,body)");
}
?>