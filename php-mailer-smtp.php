<?php
// Require the PHPMailer classes
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

// Create a new instance of the PHPMailer class
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set the email sending protocol to SMTP
$mail->IsSMTP();

// Enable HTML email format
$mail->IsHTML(true);

// Set the character set to UTF-8
$mail->CharSet="UTF-8";

// Set the email host
$mail->Host = "EMAIL-HOST";

// Enable debugging
$mail->SMTPDebug = 1;

// Set the port number
$mail->Port = 587;

// Set the SMTP secure type to TLS
$mail->SMTPSecure = 'tls';

// Enable SMTP authentication
$mail->SMTPAuth = true;

// Set the username and password for SMTP authentication
$mail->Username = "USER-NAME";
$mail->Password = "PASSWORD-HERE";

// Set the "From" email address and name
$mail->setfrom("SET-FROM-EMAIL","FROM-NAME");

// Set the recipient email address
$mail->AddAddress("RECEPIENT-ADDRESS");

// Set the email subject
$mail->Subject = "SUBJECT HERE";

// Set the email body
$mail->Body = "EMAIL BODY HERE";

// Send the email
if(!$mail->Send()) {
    // If the email fails to send, display the error message
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    // If the email is sent successfully, display a success message
    echo "Message has been sent";
}
?>