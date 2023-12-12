<?php

require('fpdf.php');

function generatePDF($imagePath, $idText, $idFontSize, $dateText, $dateFontSize, $presentedToText, $presentedToFontSize, $additionalText, $additionalFontSize, $outputPath)
{
    // Create a new FPDF instance
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', 'B', 16);

    // Output image on PDF
    $pdf->Image($imagePath, 10, 10, 190);

    // Set text color
    $pdf->SetTextColor(0, 0, 0);

    // ID Text
    $pdf->SetXY(20, 80);
    $pdf->SetFont('Arial', 'B', $idFontSize);
    $pdf->MultiCell(0, 10, $idText, 0, 'L');

    // Date Text
    $pdf->SetXY(20, 90);
    $pdf->SetFont('Arial', 'B', $dateFontSize);
    $pdf->MultiCell(0, 10, $dateText, 0, 'L');

    // Presented To Text
    $pdf->SetXY(100, 120);
    $pdf->SetFont('Arial', 'B', $presentedToFontSize);
    $pdf->MultiCell(0, 10, $presentedToText, 0, 'C');

    // Additional Text
    $pdf->SetXY(30, 150);
    $pdf->SetFont('Arial', 'B', $additionalFontSize);
    $pdf->MultiCell(0, 10, $additionalText, 0, 'L');

    // Save the PDF to a file
    $pdf->Output($outputPath, 'F');

    // Return the output path
    return $outputPath;
}


// Get the certificate ID from the query parameters
$certificateId = $_GET['certificate_id'];

// Fetch data from the database based on the certificate ID (similar to your existing code)
// Replace the following placeholders with the actual database connection and query logic
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
        'https://www.certificate.creativeit.xyz/front/images/certificate/certificate5.jpg',
        "ID No: {$row['certificate_id']}",
        24,
        "Date of Issue: {$row['certificate_date']}",
        24,
        "Presented to {$row['name']}",
        28,
        "Child of {$row['father_name']} & {$row['mother_name']} has successfully completed the {$row['course_name']} course held on 30 August 2021 to 02 March 2022 at Creative IT Institute.",
        20,
        'output_fpdf.pdf'
    );
    
    

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Trigger the download
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
