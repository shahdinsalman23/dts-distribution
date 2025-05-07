<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include the Composer autoload file

$mail = new PHPMailer(true); // Create a new PHPMailer instance
session_start();

try {

    // dd('hello world');
   
    //Server settings
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host       = 'smtp.hostinger.com';         // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
    $mail->Username   = 'shahdinsalman@gmail.com';     // SMTP username
    $mail->Password   = 'April2024$$';                 // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                        // TCP port to connect to

    //Recipients
    $mail->setFrom('info@dynamics-digital.com', 'Dynamics Digital');
    $mail->addAddress('info@dynamics-digital.com', 'Dynamics Digital'); // Add a recipient

    //Attachments
    //$mail->addAttachment('/path/to/file.pdf');    // Add attachments
    //$mail->addAttachment('/path/to/image.jpg', 'new.jpg'); // Optional name
        
    //Content
    $mail->isHTML(true);                            // Set email format to HTML
    $mail->Subject = 'Query From Customer';
    $mail->Body    = 
                    'Name:'.$_POST['first_name'] .'<br/>'
                    .'Last Name:'.$_POST['last_name'] .'<br/>'
                    .'Email:'.$_POST['email_address'] .'<br/>'
                    .'Phone:'.$_POST['phone_number'] .'<br/>'
                     .'Query Topic:'.$_POST['query_topic']??''.'<br/>'
                    .'Message:'.$_POST['text_message']??''.'<br/>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $_SESSION['message'] = 'Thank you for reaching out to us. We have received your message and will respond to you shortly.';

    } catch (Exception $e) {
        $_SESSION['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: contact.html");
?>
