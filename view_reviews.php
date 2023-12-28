<?php
include 'navbar.php';
session_start();

// Retrieve reviews data from the session
$reviews = isset($_SESSION['reviews']) ? $_SESSION['reviews'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl text-center font-bold mb-4">Reviews</h2>
        <?php
        foreach ($reviews as $review) {
            echo "<div class='bg-gray-300 p-4 mb-4 shadow-md rounded-md'>";
            echo "<h3 class='text-xl font-bold mb-2'>{$review['author']}</h3>";
            echo "<p class='text-gray-600 mb-2'>{$review['position']}</p>";
            echo "<p>{$review['content']}</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>

<?php
include 'footer.php';
?>

</html>
