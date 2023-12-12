<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("connection failed" . $conn->connect_error);
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


if($conn->query($sql)=== TRUE){
    echo "<h2>Data added Successfully!</h2>";
} else {
    echo "Error: ";
}

$conn->close();
?>