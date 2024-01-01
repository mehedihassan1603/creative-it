<?php

include 'config.php';

$searchId = $_GET['certificate_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE certificate_id = ?");
$stmt->bind_param("s", $searchId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $certificateImage = imagecreatefromjpeg('https://www.certificate.creativeit.xyz/front/images/certificate/certificate5.jpg');
    $qrcertificateImage = imagecreatefrompng('save/qr_code.png');

    $fontColor = imagecolorallocate($certificateImage, 0, 0, 0);

    $fontPath = 'Arial/arial.ttf'; 

    imagettftext($certificateImage, 18, 0, 300, 500, $fontColor, $fontPath, "ID No:");
    imagettftext($certificateImage, 18, 0, 300, 530, $fontColor, 'Arial/arial_bold.ttf', "{$row['certificate_id']}");
    imagettftext($certificateImage, 18, 0, 300, 570, $fontColor, $fontPath, "Date of Issue:"); // Change "ID No:" to "Date of Issue:"
    imagettftext($certificateImage, 18, 0, 300, 600, $fontColor, 'Arial/arial_bold.ttf', "{$row['certificate_date']}");
    imagettftext($certificateImage, 20, 0, 530, 480, $fontColor, $fontPath, "Presented to");
    imagettftext($certificateImage, 24, 0, 530, 520, $fontColor, 'Arial/arial_bold.ttf', "{$row['name']}");
    imagettftext($certificateImage, 16, 0, 530, 560, $fontColor, $fontPath, "Child of {$row['father_name']} & {$row['mother_name']} has successfully ");
    imagettftext($certificateImage, 16, 0, 530, 590, $fontColor, $fontPath, "completed the {$row['course_name']} course held on 30 August 2021 to 02 March 2022 ");
    imagettftext($certificateImage, 16, 0, 530, 620, $fontColor, $fontPath, "at Creative IT Institute.");

    imagecopy($certificateImage, $qrcertificateImage, 330, 650, 0, 0, imagesx($qrcertificateImage), imagesy($qrcertificateImage));

    header('Content-Type: image/jpeg');
    imagejpeg($certificateImage);

    imagedestroy($certificateImage);
    imagedestroy($qrcertificateImage);
} else {
    echo "No Matching record found";
}

$stmt->close();
$conn->close();

?>
