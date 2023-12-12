<?php
require('fpdf.php');

function generatePDF($imagePath, $overlayText, $outputPath)
{
    // Create a new FPDF instance
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', 'B', 16);

    // Output image on PDF
    $pdf->Image($imagePath, 10, 10, 190);

    // Set text color
    $pdf->SetTextColor(255, 0, 0);

    // Set position for overlay text
    $pdf->SetXY(100, 150);

    // Add overlay text
    $pdf->Cell(0, 10, $overlayText, 0, 1, 'C');

    // Save the PDF to a file
    $pdf->Output($outputPath, 'F');
}

// Example usage
generatePDF('path/to/your/image.jpg', 'Overlay Text', 'output_fpdf.pdf');
?>
