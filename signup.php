<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM `users` WHERE `email`='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo '<div id="error-alert" style="background-color: red; color: white; margin-top:30px; padding:10px;" class="bg-red-400 text-white text-xl mt-10 p-4 rounded mt-4">
                <h1>Email already exists! Please choose another email.</h1>
            </div>';
    } else {
        // Insert new record if the email doesn't exist
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("refresh:2;url=admin.php?page=dashboard");
            echo '<div id="success-alert" style="background-color: blue; color: white; margin-top:30px; padding:10px;" class="bg-blue-400 text-white text-xl mt-10 p-4 rounded mt-4">
                    <h1>Account created successfully! Redirecting...</h1>
                </div>';
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Sign Up</h2>
        <form method="post" action="SignUp.php" class="mt-4">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" name="signup_submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Sign Up
            </button>
        </form>
        <div class="mt-4 text-center">
            <p>Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
        </div>
    </div>

</body>

</html>
