<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentId = $_POST['id'];
$updatedCertificateId = $_POST['certificate_id'];
$updatedName = $_POST['name'];
$updatedFatherName = $_POST['father_name'];
$updatedMotherName = $_POST['mother_name'];
$updatedCourseName = $_POST['course_name'];
$updatedBatchNumber = $_POST['batch_number'];
$updatedCourseEndDate = $_POST['course_end_date'];
$updatedCertificateDate = $_POST['certificate_date'];
$updatedEmail = $_POST['email'];
$updatedPassword = $_POST['password']; 

$updateStudentQuery = "UPDATE students SET
    certificate_id = '$updatedCertificateId',
    name = '$updatedName',
    father_name = '$updatedFatherName',
    mother_name = '$updatedMotherName',
    course_name = '$updatedCourseName',
    batch_number = '$updatedBatchNumber',
    course_end_date = '$updatedCourseEndDate',
    certificate_date = '$updatedCertificateDate',
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
        <h3 class="text-2xl font-bold mb-4">Student Details Updated</h3>
        <p class="text-gray-700 mb-4">The student details have been successfully updated.</p>
        <a href="/cit/admin.php" class="text-blue-500 hover:underline">Back to Profile</a>
    </div>

</body>

</html>

