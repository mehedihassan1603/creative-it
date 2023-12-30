<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $photo = $_POST["photo"];
    $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0;
    $details = $_POST["details"];

    $insertQuery = "INSERT INTO reviews (name, photo, rating, details) VALUES ('$name', '$photo', $rating, '$details')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Record added successfully";
        header("refresh:1;url=/cit/admin.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews (Editable)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4">Reviews (Editable)</h2>

        <form method="post" action="">
            <label for="name" class="block mb-2 font-bold">Name:</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border rounded">

            <label for="photo" class="block mb-2 font-bold">Photo:</label>
            <input type="text" id="photo" name="photo" required class="w-full px-4 py-2 mb-4 border rounded">

            <label for="rating" class="block mb-2 font-bold">Rating:</label>
            <div class="rating">
                <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-green-500" />
                <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-green-500" />
                <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-green-500" />
                <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-green-500" />
                <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-green-500" checked />
            </div>

            <label for="details" class="block mb-2 font-bold">Details:</label>
            <textarea id="details" name="details" required class="w-full px-4 py-2 mb-4 border rounded"></textarea>

            <input type="submit" value="Save Changes" class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer">
        </form>
    </div>

</body>

</html>