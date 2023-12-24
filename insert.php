<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$certificateId = $_POST['certificate_id'];
$name = $_POST['name'];
$fatherName = $_POST['father_name'];
$motherName = $_POST['mother_name'];
$courseName = $_POST['course_name'];
$batchNumber = $_POST['batch_number'];
$courseEndDate = $_POST['course_end_date'];
$certificateDate = $_POST['certificate_date'];

$sql = "INSERT INTO students (certificate_id, name, father_name, mother_name, course_name, batch_number, course_end_date, certificate_date)
        VALUES ('$certificateId', '$name', '$fatherName', '$motherName', '$courseName', '$batchNumber', '$courseEndDate', '$certificateDate')";

if ($conn->query($sql) === TRUE) {
    header("refresh:2;url=admin.php?page=students");
    echo '<div id="success-alert" style="background-color: blue; color: white; margin-top:30px; padding:20px;" class="bg-blue-400 text-white text-xl mt-10 p-4 rounded mt-4">
            <h1>Infomation Add Succcessfully! Wait a second...</h1>
        </div>';
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
