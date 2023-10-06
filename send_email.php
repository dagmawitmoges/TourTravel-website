<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


$mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username@example.com'; 
    $mail->Password = 'your_password'; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587;

    
    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

   
    $mail->isHTML(true); 
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email sent using PHPMailer.';

  
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo 'Email sending failed: ' . $mail->ErrorInfo;
}
?>
