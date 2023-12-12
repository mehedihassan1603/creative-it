<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$searchId = $_GET['certificate_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE certificate_id = ?");
$stmt->bind_param("s", $searchId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div style='width: 80%; margin-left: auto; margin-right: auto;'>";
    echo "<h2 style='color: #05613F; background-color: #12EA9C; padding: 5px; border-radius: 10px'>Certified</h2>";
    echo "<div style='display: flex;'>";
    echo "<div style='width: 50%; padding-left:40px;'>";
    echo "<h4>Certificate ID: {$row['certificate_id']}</h4>";
    echo "<h4>Name: {$row['name']}</h4>";
    echo "<h4>Father's Name: {$row['father_name']}</h4>";
    echo "<h4>Mother's Name: {$row['mother_name']}</h4>";
    echo "</div>";
    echo "<div style='width: 50%;'>";
    echo "<h4>Course Name: {$row['course_name']}</h4>";
    echo "<h4>Batch Number: {$row['batch_number']}</h4>";
    echo "<h4>Course End Date: {$row['course_end_date']}</h4>";
    echo "<h4>Certificate Date: {$row['certificate_date']}</h4>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "<h2>Generate Certificate Form:</h2>";
    echo "<div style='position: relative;'>";
    echo "<img src='https://www.certificate.creativeit.xyz/front/images/certificate/certificate5.jpg' width='100%'>";
    echo "<div style='position: absolute;top: 45%;left: 20%;transform: translate(-50%, -50%);color: black;'>";
    echo "<p><span style='font-size: 24px; text-align: left;'>ID No:</span> <br><span style='font-size: 24px; font-weight: bold; text-align: left;'>{$row['certificate_id']}</span> <br> <br><span><span style='font-size: 24px; text-align: left;'>Date of Issue:</span> <br><span style='font-size: 24px; font-weight: bold; text-align: left;'>{$row['certificate_date']}</span> </p>";
    echo "</div>";
   
    echo "<div style='position: absolute;top: 45%;left: 35%;transform: translate(-50%, -50%);text-align: center;color: black;font-size: 2em;'>";
    echo "<p style='font-size: 24px; text-align: left;'>Presented to<br><span style='font-size: 28px; font-weight: bold; text-align: left;'>{$row['name']}</span></p>";
    echo "</div>";
    echo "<div style='position: absolute;top: 50.5%;left: 53.5%;transform: translate(-50%, -50%);color: black;'>";
    echo "<p style='font-size: 20px; text-align: left;'>Child of {$row['father_name']} & {$row['mother_name']} has successfully completed the {$row['course_name']} course held on 30 August 2021 to 02 March 2022 at Creative IT Institute.</p>";
    echo "</div>";
    echo "</div>";
    
    // Add a link to trigger PDF generation and download
    echo "<a href='generate_pdf.php?certificate_id={$row['certificate_id']}'><button>Download PDF</button></a>";
    
    echo "</div>";
} else {
    echo "No Matching record found";
}

$stmt->close();
$conn->close();

?>
