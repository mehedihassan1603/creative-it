<?php

include 'config.php';

$certificateId = $_POST['certificate_id'];
$name = $_POST['name'];
$fatherName = $_POST['father_name'];
$motherName = $_POST['mother_name'];
$courseName = $_POST['course_name'];
$batchNumber = $_POST['batch_number'];
$courseEndDate = $_POST['course_end_date'];
$certificateDate = $_POST['certificate_date'];
$email = $_POST['email'];
$userPassword = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$checkCertificateIdSql = "SELECT * FROM students WHERE certificate_id = '$certificateId'";
$checkCertificateIdResult = $conn->query($checkCertificateIdSql);

$checkEmailSql = "SELECT * FROM students WHERE email = '$email'";
$checkEmailResult = $conn->query($checkEmailSql);

if ($checkCertificateIdResult->num_rows > 0) {
    echo '<div id="error-alert" style="background-color: red; color: white; margin-top:30px; padding:20px;" class="bg-red-400 text-white text-xl mt-10 p-4 rounded mt-4">
            <h1>Certificate ID already exists. Please use a different one.</h1>
        </div>';
} elseif ($checkEmailResult->num_rows > 0) {
    echo '<div id="error-alert" style="background-color: red; color: white; margin-top:30px; padding:20px;" class="bg-red-400 text-white text-xl mt-10 p-4 rounded mt-4">
            <h1>Email already exists. Please use a different one.</h1>
        </div>';
} else {
    $insertSql = "INSERT INTO students (certificate_id, name, father_name, mother_name, course_name, batch_number, course_end_date, certificate_date, email, `password`, `address`, `phone`)
        VALUES ('$certificateId', '$name', '$fatherName', '$motherName', '$courseName', '$batchNumber', '$courseEndDate', '$certificateDate', '$email', '$userPassword', '$address', '$phone')";

    if ($conn->query($insertSql) === TRUE) {
        header("refresh:2;url=/cit/admin.php");
        echo '<div id="success-alert" style="background-color: blue; color: white; margin-top:30px; padding:20px;" class="bg-blue-400 text-white text-xl mt-10 p-4 rounded mt-4">
                <h1>Information added successfully! Wait a second...</h1>
            </div>';
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
