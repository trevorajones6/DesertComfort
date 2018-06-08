<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = ';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Sender
	$mail->setFrom('Contact@Desertcomfort.com', 'Website Contact');
	
	//Recipients
    $mail->addAddress('Rick@desertcomfortac.com', 'Rick Jones');     // Add a recipient

	$body = "<p><strong>Hello</strong>, you have received an enquiry from " . $name . " the message is " . $message . " you can contact at " . $phone . "</p>";

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Website Contact from' . $name;
	
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>
