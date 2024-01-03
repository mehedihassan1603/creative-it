<?php
include 'config.php';

$name = $_POST['name'];
$facebook = $_POST['facebook'];
$linkdin = $_POST['linkdin'];
$youtube = $_POST['gmail'];
$phone = $_POST['phone'];
$develop = $_POST['develop'];

$sql = "INSERT INTO information (name, facebook, linkdin, gmail, phone, develop) VALUES ('$name', '$facebook', '$linkdin', '$youtube', '$phone', '$develop')";
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

mysqli_close($conn);
?>
