<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `students` WHERE `email`='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        if ($password === $storedPassword) {
            $_SESSION['email'] = $email;
            header("Location: studentsDashboard.php");
            exit();
        } else {
            echo '<div id="error-alert" style="background-color: red; color: white; margin-top:30px; padding:10px;" class="bg-red-400 text-white text-xl mt-10 p-4 rounded mt-4">
                    <h1>Incorrect password! Please try again.</h1>
                </div>';
        }
    } else {
        echo '<div id="error-alert" style="background-color: red; color: white; margin-top:30px; padding:10px;" class="bg-red-400 text-white text-xl mt-10 p-4 rounded mt-4">
                <h1>Email not found! Please sign up.</h1>
            </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Login</h2>
        <form method="post" action="studentLogin.php" class="mt-4">
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
            <button type="submit" name="login_submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Login
            </button>
        </form>
        <div class="mt-4 text-center">
            <p>Don't have an account? <a href="studentSignup.php" class="text-blue-500">Sign Up</a></p>
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