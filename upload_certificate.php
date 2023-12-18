<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
        $uploadDir = "certificate/"; 
        $fixedFileName = "template.png";
        $uploadPath = $uploadDir . $fixedFileName;

        if (file_exists($uploadPath)) {
            unlink($uploadPath); 
        }

        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadPath)) {
            echo "Logo uploaded successfully.";
            echo "<br>";
            echo "Logo path: " . $uploadPath;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error: Please select a file to upload.";
    }
}
?>
