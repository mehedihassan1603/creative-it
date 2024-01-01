<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $admin_email = "mh93075@gmail.com";
    $subject = "New Message from Contact Form";

    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($admin_email, $subject, $message, $headers);

    header("Location: thanks.php");
    exit();
}
?>
