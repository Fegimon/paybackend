<?php

require_once "PHPMailer-master/PHPMailerAutoload.php";

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "silambarasandp12@gmail.com";
$mail->FromName = "Silambarasan";

//To address and name
$mail->addAddress("simb143123@gmail.com", " simbu");
$mail->addAddress("simb143123@gmail.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("silambarasandp12@gmail.com", "Reply");

//CC and BCC
$mail->addCC("sim9786706043@gmail.com");
$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}