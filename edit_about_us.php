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
    $designation = $_POST["designation"];
    $details = $_POST["details"];

    $insertQuery = "INSERT INTO about (name, designation, details) VALUES ('$name', '$designation', '$details')";

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
    <title>About Us (Editable)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4">About Us (Editable)</h2>

        <form method="post" action="">
            <label for="name" class="block mb-2 font-bold">Name:</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border rounded">

            <label for="designation" class="block mb-2 font-bold">Designation:</label>
            <input type="text" id="designation" name="designation" required class="w-full px-4 py-2 mb-4 border rounded">

            <label for="details" class="block mb-2 font-bold">Details:</label>
            <textarea id="details" name="details" required class="w-full px-4 py-2 mb-4 border rounded"></textarea>

            <input type="submit" value="Save Changes" class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer">
        </form>
    </div>

</body>

</html>
