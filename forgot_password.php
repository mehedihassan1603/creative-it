<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['forgot_submit'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    $sql = "UPDATE `users` SET `reset_token`='$token' WHERE `email`='$email'";
    $result = $conn->query($sql);

    if ($result) {
        $reset_link = "http://localhost/cit/reset_password.php?token=$token";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = "mehedi.hassan.16032000@gmail.com";
        $mail->Password = "umbrella2016";
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('mehedi.hassan.16032000@gmail.com', 'Mehedi');
        $mail->addAddress($email);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click the following link to reset your password: $reset_link";

        try {
            $mail->send();
            echo 'Reset link sent to your email.';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo "Error updating token: " . $conn->error;
    }
}
?>
<!-- ... (rest of the HTML code remains unchanged) -->

<!-- ... (rest of the HTML code remains unchanged) -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Forgot Password</h2>
        <form method="post" action="forgot_password.php" class="mt-4">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" name="forgot_submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Send Reset Link
            </button>
        </form>
        <div class="mt-4 text-center">
            <p>Remember your password? <a href="login.php" class="text-blue-500">Login</a></p>
        </div>
        <div class="flex justify-center">
            <button
                class="bg-green-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600 focus:outline-none focus:shadow-outline-blue">
                <a href="index.php">Back to home</a>
            </button>
        </div>
    </div>

</body>

</html>
