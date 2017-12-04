<?php
require './vendor/autoload.php';
$mail = new PHPMailer; 
$mail->isSMTP(); 
$mail->setFrom('anuthomasiducula@gmail.com', 'Admin'); 
$mail->addAddress('anuksebastian@gmail.com','Admin'); 
$mail->Username = ''; 
$mail->Password = ''; 
$mail->Host = 'email-smtp.us-east-1.amazonaws.com'; 
$mail->Subject = 'Amazon SES test (SMTP interface accessed using PHP)';
$mail->Body = '<h1>Thank you for donating food.</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>'; 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls'; 
$mail->Port = 587; 
$mail->isHTML(true); 
$mail->AltBody = "Email Test\r\nThis email was sent through the  Amazon SES SMTP interface using the PHPMailer class."; 
if(!$mail->send()) {
    echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
} 
else {
    echo "Email sent!" , PHP_EOL;
      }
?>

