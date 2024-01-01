<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $map = $_POST["map"];

    $insertQuery = "INSERT INTO contact (name, email, phone, address, map) VALUES ('$name', '$email', '$phone', '$address', '$map')";

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
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container w-9/12 mx-auto my-8 p-8 bg-white shadow-md">

        <h1 class="text-3xl font-semibold mb-6 text-center">Contact Us</h1>

        <form action="#" method="post" class="w-full mx-auto bg-gray-300">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                <textarea id="address" name="address" rows="4" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="map" class="block text-gray-700 text-sm font-bold mb-2">Google Map iframe:</label>
                <textarea id="map" name="map" rows="4" class="w-full p-2 border rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Submit</button>
        </form>

        
    </div>

</body>

</html>