<?php
include 'navbar.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
require 'vendor/autoload.php';

include 'src/QRCode.php';
include 'src/QROptions.php';

session_start();

if (isset($_GET['style'])) {
    $_SESSION['certificate_style'] = $_GET['style'];
}
$selectedStyle = isset($_SESSION['certificate_style']) ? $_SESSION['certificate_style'] : 'default';

$searchId = $_GET['certificate_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE certificate_id = ?");
$stmt->bind_param("s", $searchId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $qrCodeText = "Certificate ID: {$row['certificate_id']}\nName: {$row['name']}";
    $qrCodeOptions = new chillerlan\QRCode\QROptions([
        'outputType' => 'png',
        'eccLevel' => chillerlan\QRCode\QRCode::ECC_L,
    ]);


    $qrCode = new chillerlan\QRCode\QRCode($qrCodeOptions);
    $qrImagePath = 'save/qr_code.png';
    $qrCode->render($qrCodeText, $qrImagePath);

    echo "<div class='text-xl mt-5 space-y-2 font-bold' style='width: 80%; margin-left: auto; margin-right: auto;'>";
    echo "<h2 class='pl-10 py-2' style='color: #00000; background-color: #12EA9C; border-radius: 10px;'>Certified</h2>";
    echo "<div style='display: flex;'>";
    echo "<div class='space-y-2' style='width: 50%; padding-left:40px;'>";
    echo "<h4>Certificate ID: {$row['certificate_id']}</h4>";
    echo "<h4>Name: {$row['name']}</h4>";
    echo "<h4>Father's Name: {$row['father_name']}</h4>";
    echo "<h4>Mother's Name: {$row['mother_name']}</h4>";
    echo "</div>";
    echo "<div class='space-y-2' style='width: 50%;'>";
    echo "<h4>Course Name: {$row['course_name']}</h4>";
    echo "<h4>Batch Number: {$row['batch_number']}</h4>";
    echo "<h4>Course End Date: {$row['course_end_date']}</h4>";
    echo "<h4>Certificate Date: {$row['certificate_date']}</h4>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "<h2 class='text-2xl mt-5 font-bold' style='text-align:center; margin-top:20px;'>Certificate Display:</h2>";
    echo "<div style='position: relative;'>";
    echo "<img style='width: 100%; margin-left: auto; margin-right: auto;' src='https://www.certificate.creativeit.xyz/front/images/certificate/certificate5.jpg'>";
    echo "<div style='position: absolute;top: 45%;left: 20%;transform: translate(-50%, -50%);color: black;'>";
    echo "<p><span style='font-size: 18px; text-align: left;'>ID No:</span> <br><span style='font-size: 18px; font-weight: bold; text-align: left;'>{$row['certificate_id']}</span> <br> <br><span><span style='font-size: 18px; text-align: left;'>Date of Issue:</span> <br><span style='font-size: 18px; font-weight: bold; text-align: left;'>{$row['certificate_date']}</span> </p>";
    echo "</div>";
    echo "<div style='display:block;position: absolute; top: 42%; left: 45.5%; transform: translate(-50%, -50%); color: black; font-size: 2em; width: 400px;'>";
    echo "<p style='font-size: 24px; text-align: left; margin: 0;'>Presented to<br><span style='font-size: 28px; font-weight: bold; text-align: left;'>{$row['name']}</span></p>";
    echo "</div>";
    echo "<div style='position: absolute;top: 48%;left: 53.7%;transform: translate(-50%, -50%);color: black;'>";
    echo "<p style='font-size: 17px; text-align: left;'>Child of <b>{$row['father_name']}</b> & <b>{$row['mother_name']}</b> has successfully completed the <b>{$row['course_name']}</b> course held on 30 August 2021 to 02 March 2022 at <span style='color: red'>Creative IT Institute.</span></p>";
    echo "</div>";
    echo "<div style='position: absolute;top: 60%;left: 22%;transform: translate(-50%, -50%);color: black;'>";
    echo "<img src='save/qr_code.png'>";
    echo "</div>";

    echo "<style>";
    echo ".button-container {";
    echo "  text-align: center;";
    echo "  justify-content: center;";
    echo "  margin-bottom: 50px;";
    echo "}";
    echo "a.button-link {";

    echo "  margin: 10px;";
    echo "  padding: 10px 20px;";
    echo "  text-decoration: none;";
    echo "  background-color: #4caf50;";
    echo "  color: #fff;";
    echo "  border: none;";
    echo "  border-radius: 4px;";
    echo "  cursor: pointer;";
    echo "  transition: background-color 0.3s;";
    echo "}";
    echo "a.button-link:hover {";
    echo "  background-color: #45a049;";
    echo "}";
    echo "</style>";

    echo "<div class='button-container'>";
    echo "<a class='button-link' href='generate_pdf.php?certificate_id={$row['certificate_id']}' target='_blank'>Download PDF</a>";
    echo "<a class='button-link' href='generate_jpg.php?certificate_id={$row['certificate_id']}' target='_blank'>Download JPG</a>";
    echo "</div>";

    echo "</div>";
} else {
    echo "No Matching record found";
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <footer class="footer p-10 bg-slate-500 text-base-content text-white">
        <aside>
            <img src="./uploads/abcdef.png" width="80px" alt="">
            <p class="text-white">Providing reliable tech since 1992</p>
        </aside>
        
        <nav>
            <header class="text-xl text-white">Company</header>
            <a href="view_about_us.php" class="link link-hover text-white">About us</a>
        </nav>
        <nav>
            <header class="text-xl text-white">Legal</header>
            <a class="link link-hover text-white">Terms of use</a>
            <a class="link link-hover text-white">Privacy policy</a>
            <a class="link link-hover text-white">Cookie policy</a>
        </nav>
    </footer>
</body>

</html>

