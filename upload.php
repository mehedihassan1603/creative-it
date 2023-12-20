<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
        $uploadDir = "uploads/"; 
        $fixedFileName = "abcdef.png";
        $uploadPath = $uploadDir . $fixedFileName;

        if (file_exists($uploadPath)) {
            unlink($uploadPath); 
        }

        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadPath)) {
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading the file.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: Please select a file to upload.']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}
?>
