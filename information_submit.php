<?php
include 'config.php';

$name = $_POST['name'];
$facebook = $_POST['facebook'];
$linkdin = $_POST['linkdin'];
$youtube = $_POST['gmail'];
$phone = $_POST['phone'];
$develop = $_POST['develop'];

// Handle file upload
$targetDirectory = "uploads/"; // Change this to your desired directory
$photo = $_FILES['photo']['name'];
$targetFilePath = $targetDirectory . $photo;
$uploadOk = 1;

// Check if file already exists
if (file_exists($targetFilePath)) {
    echo "Sorry, the file already exists.";
    $uploadOk = 0;
}

// Check file size (you can set your own size limit)
// if ($_FILES['photo']['size'] > 900000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }

// Allow certain file formats (you can set your own formats)
$allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
$fileFormat = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
if (!in_array($fileFormat, $allowedFormats)) {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // If everything is OK, try to upload the file
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
        $sql = "INSERT INTO information (name, facebook, linkdin, gmail, phone, develop, photo) VALUES ('$name', '$facebook', '$linkdin', '$youtube', '$phone', '$develop', '$photo')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Information submitted successfully. Please wait...";
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "admin.php";
                    }, 2000);
                  </script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

mysqli_close($conn);
?>
