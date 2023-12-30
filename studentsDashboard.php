<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: studentLogin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM `students` WHERE `email`='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $fatherName = $row['father_name'];
    $motherName = $row['mother_name'];
    $email = $row['email'];
    $certificateId = $row['certificate_id'];
} else {
    
    header("Location: studentLogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Student Dashboard</h2>
        <div class="mt-4">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Father's Name:</strong> <?php echo $fatherName; ?></p>
            <p><strong>Mother's Name:</strong> <?php echo $motherName; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Certificate ID:</strong> <?php echo $certificateId; ?></p>
        </div>

        <div class="flex justify-center mt-4">
            <a href="search.php?certificate_id=<?php echo $certificateId; ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:shadow-outline-blue">
                View Certificate
            </a>
        </div>

        <div class="flex justify-center mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                <a href="studentLogout.php">Logout</a>
            </button>
        </div>
    </div>

</body>

</html>
