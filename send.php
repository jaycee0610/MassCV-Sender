<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$email_receiver = $_GET['email'];
$position = $_GET['position'] ?? 'Web Developer';


//Details
$name = 'Your Name';
$cv = 'your_cv.pdf';
$contact_number = '09123456789';

//SMTP Settings (Gmail)
$email_address = 'youremail-address@gmail.com';
$password = 'your-app-password'; //To get app password : go to Manage Google Account > Security > App passwords (Note: you must enable 2FA)


//Mail Settings
$subject = 'Application for ' . $position;
$html_body = 'I hope this message finds you well. My name is '.$name.', and I am writing to express my strong interest in the <b>'.$position.'</b> position, I am confident in my ability to contribute to your team.<br><br>Best Regards,<br>'.$name.'<br>'.$contact_number.'';
$alt_body = 'I hope this message finds you well. My name is '.$name.', and I am writing to express my strong interest in the '.$position.' position, I am confident in my ability to contribute to your team.\n\nBest Regards,\n'.$name.'\n'.$contact_number.'';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = $email_address;
    $mail->Password = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    //Recipients
    $mail->setFrom($email_address, $name);
    $mail->addAddress($email_receiver);


    // Setting the email as High Priority
    $mail->Priority = 1;
    $mail->AddCustomHeader("X-Priority: 1 (Highest)");
    $mail->AddCustomHeader("X-MSMail-Priority: High");
    $mail->AddCustomHeader("Importance: High");
    $mail->addAttachment($cv);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $html_body;
    $mail->AltBody = $alt_body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
