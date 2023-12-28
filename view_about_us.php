<?php
include 'navbar.php';
session_start();

$teamMembers = isset($_SESSION['teamMembers']) ? $_SESSION['teamMembers'] : array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl text-center font-bold mb-4">About Us</h2>
        <?php
        foreach ($teamMembers as $member) {
            echo "<div class='bg-gray-300 p-4 mb-4 shadow-md rounded-md'>";
            echo "<h3 class='text-xl font-bold mb-2'>{$member['name']}</h3>";
            echo "<p class='text-gray-600 mb-2'>{$member['position']}</p>";
            echo "<p>{$member['bio']}</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>

<?php
include 'footer.php';
?>

</html>
