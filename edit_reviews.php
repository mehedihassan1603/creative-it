<?php
session_start();

$reviews = array(
    array('id' => 1, 'author' => 'John Doe', 'position' => 'Customer', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($reviews as &$review) {
        $id = $review['id'];
        $review['author'] = isset($_POST["author_$id"]) ? $_POST["author_$id"] : $review['author'];
        $review['position'] = isset($_POST["position_$id"]) ? $_POST["position_$id"] : $review['position'];
        $review['content'] = isset($_POST["content_$id"]) ? $_POST["content_$id"] : $review['content'];
    }
    $_SESSION['reviews'] = $reviews;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews (Editable)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4">Reviews (Editable)</h2>

        <form method="post" action="">
            <?php
            foreach ($reviews as $review) {
                echo "<div class='bg-white p-4 mb-4 shadow-md rounded-md'>";
                echo "<input type='text' name='author_{$review['id']}' value='{$review['author']}' class='text-xl font-bold mb-2'>";
                echo "<input type='text' name='position_{$review['id']}' value='{$review['position']}' class='text-gray-600 mb-2'>";
                echo "<textarea name='content_{$review['id']}' class='mb-2'>{$review['content']}</textarea>";
                echo "</div>";
            }
            ?>
            <input type="submit" value="Save Changes" class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer">
        </form>
    </div>

</body>

</html>
