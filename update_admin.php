<?php
include 'config.php';

$studentId = $_POST['id'];
$updatedName = $_POST['name'];
$updatedEmail = $_POST['email'];
$updatedPassword = $_POST['password']; 

$updateStudentQuery = "UPDATE users SET
    name = '$updatedName',
    `email` = '$updatedEmail',
    `password` = '$updatedPassword'
    WHERE id = $studentId";

$conn->query($updateStudentQuery);
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
        <h3 class="text-2xl font-bold mb-4">Admin Details Updated</h3>
        <p class="text-gray-700 mb-4">The student details have been successfully updated.</p>
        <a href="/cit/admin.php" class="text-blue-500 hover:underline">Back to Profile</a>
    </div>

</body>

</html>

