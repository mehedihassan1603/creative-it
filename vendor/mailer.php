<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// Enable SMTP debugging
$mail->SMTPDebug = 3;
$mail->Debugoutput = function ($str, $level) {
    file_put_contents('smtp_debug.log', $str, FILE_APPEND);
};

try {
    // Configure your $mail object here

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "mehedi.hassan.16032000@gmail.com";
    $mail->Password = "fxot acvp dhiy fcik";

    // Additional configuration if needed

    // Use $mail to send emails
    // $mail->setFrom("your_email@gmail.com", "Your Name");
    // $mail->addAddress("recipient@example.com", "Recipient Name");
    // $mail->Subject = "Your Subject";
    // $mail->Body = "Your HTML message";

    // Uncomment the following line to send the email
    // $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>