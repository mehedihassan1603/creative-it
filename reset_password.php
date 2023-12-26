<?php
session_start();

require 'PHPMailer-master/src/PHPMailer.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM `users` WHERE `reset_token`='$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Token is valid, allow the user to reset their password
        if (isset($_POST['reset_submit'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the user's password and reset the token
                $row = $result->fetch_assoc();
                $user_id = $row['user_id']; // Replace 'user_id' with your actual user ID column name
                $sql_update = "UPDATE `users` SET `password`='$hashed_password', `reset_token`=NULL WHERE `user_id`='$user_id'";
                $result_update = $conn->query($sql_update);

                if ($result_update) {
                    echo "Password reset successfully. <a href='login.php'>Login</a>";
                    exit();
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "Passwords do not match.";
            }
        }
    } else {
        echo "Invalid token";
        exit();
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
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Reset Password</h2>
        <form method="post" action="reset_password.php?token=<?php echo $token; ?>" class="mt-4">
            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 font-bold mb-2">New Password:</label>
                <input type="password" id="new_password" name="new_password" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 font-bold mb-2">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" name="reset_submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Reset Password
            </button>
        </form>
        <div class="flex justify-center">
            <button
                class="bg-green-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600 focus:outline-none focus:shadow-outline-blue">
                <a href="index.php">Back to home</a>
            </button>
        </div>
    </div>

</body>

</html>
