<?php
require('fpdf.php');

function generatePDF($imagePath, $overlayText, $outputPath)
{
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Image($imagePath, 10, 10, 190);

    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetXY(100, 150);

    $pdf->Cell(0, 10, $overlayText, 0, 1, 'C');

    $pdf->Output($outputPath, 'F');
}

generatePDF('path/to/your/image.jpg', 'Overlay Text', 'output_fpdf.pdf');
?>
