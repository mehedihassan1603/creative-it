<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $name1 = $_POST["name1"];
    $name2 = $_POST["name2"];
    $name3 = $_POST["name3"];
    $insertQuery = "INSERT INTO privacy (name, name1, name2, name3) VALUES ('$name', '$name1', '$name2', '$name3')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Record added successfully";
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
    <title>Privacy(edit)</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container w-9/12 mx-auto mb-8 p-8 bg-white shadow-md">

        <h1 class="text-3xl font-semibold mb-6 text-center">Privacy and Policy</h1>

        <form action="#" method="post" class="w-full mx-auto bg-gray-300">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Privacy:</label>
                <textarea id="name" name="name" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="name1" class="block text-gray-700 text-sm font-bold mb-2">1. Acceptance of Terms</label>
                <textarea id="name1" name="name1" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="name2" class="block text-gray-700 text-sm font-bold mb-2">2. User Conduct</label>
                <textarea id="name2" name="name2" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="name3" class="block text-gray-700 text-sm font-bold mb-2">5. Modifications</label>
                <textarea id="name3" name="name3" class="w-full p-2 border rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Submit</button>
        </form>

    </div>

</body>

</html>