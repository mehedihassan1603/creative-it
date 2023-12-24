<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you receive the student ID through a GET parameter
$studentId = $_GET['id'];

// Delete the student from the database
$deleteStudentQuery = "DELETE FROM students WHERE id = $studentId";
$conn->query($deleteStudentQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h3 class="text-2xl font-bold mb-4">Student Record Deleted</h3>
        <p class="text-gray-700 mb-4">The student record have been successfully updated.</p>
        <a href="admin.php?page=students" class="text-blue-500 hover:underline">Back to Students List</a>
    </div>

</body>

</html>
