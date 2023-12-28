<?php
session_start();

$reviews = isset($_SESSION['reviews']) ? $_SESSION['reviews'] : array();
$teamMembers = isset($_SESSION['teamMembers']) ? $_SESSION['teamMembers'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <nav class="flex justify-between items-center bg-gray-800 text-white p-4">
        <div>
            <img src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo" width="80px">
        </div>
        <div>
            <ul class="flex">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </nav>
    <?php
    include 'banner.php';
    ?>

    
    <?php
    $formAction = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedSearchType = $_POST['searchType'];
        switch ($selectedSearchType) {
            case 'search':
                $formAction = 'search.php';
                break;
            case 'search_sec':
                $formAction = 'search_sec.php';
                break;
            default:

                $formAction = '';
                break;
        }
    }
    ?>

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

    <?php
    include 'footer.php';
    ?>
</body>

</html>