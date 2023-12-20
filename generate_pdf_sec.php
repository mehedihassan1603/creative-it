<?php

require('fpdf.php');

function generatePDF($imagePath, $presentedToText, $presentedToFontSize, $additionalText, $additionalFontSize, $qrImagePath, $outputPath)
{
    
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 16);

    $pdf->Image($imagePath, 10, 10, 190);

    $pdf->SetTextColor(0, 0, 0);
    
    $pdf->SetXY(60, 70);
    $pdf->SetFont('Times', 'B', $presentedToFontSize);
    $pdf->MultiCell(0, 10, $presentedToText, 0, 'L');

    $pdf->SetXY(40, 83);
    $pdf->SetFont('Arial', '', $additionalFontSize);
    $pdf->MultiCell(100, 5, $additionalText, 0, 'L');

   
    $pdf->Image($qrImagePath, 81, 100, 15, 15);


    $pdf->Output($outputPath, 'F');

    return $outputPath;
}



$certificateId = $_GET['certificate_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM students WHERE certificate_id = ?");
$stmt->bind_param("s", $certificateId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $pdfPath = generatePDF(
        'certificate/SeminarCertificate.png',
        "{$row['name']}",
        17,
        "Child of {$row['father_name']} & {$row['mother_name']} has successfully completed the {$row['course_name']} course held on 30 August 2021 to 02 March 2022 at Creative IT Institute.",
        10,
        'save/qr_code.png',
        'output_fpdf_sec.pdf'
    );
    
    

    $stmt->close();
    $conn->close();

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($pdfPath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdfPath));
    readfile($pdfPath);
    exit;
} else {
    echo "No matching record found for the specified certificate ID.";
}

$stmt->close();
$conn->close();

?>
