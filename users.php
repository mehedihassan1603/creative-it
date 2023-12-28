<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$usersQuery = "SELECT id, name, email, password FROM students";
$usersResult = $conn->query($usersQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-800 text-white">

    <div class="container mx-auto p-8">
        <h3 class="text-3xl text-center mt-4">Users Information</h3>

        <table class="mt-4 mx-auto">
            <tr>
                <th class="bg-green-500 text-white py-2 px-4">Serial Number</th>
                <th class="bg-green-500 text-white py-2 px-4">Name</th>
                <th class="bg-green-500 text-white py-2 px-4">Email</th>
                <th class="bg-green-500 text-white py-2 px-4">Password</th>
                <th class="bg-green-500 text-white py-2 px-4">Edit</th>
                <th class="bg-green-500 text-white py-2 px-4">Delete</th>
            </tr>

            <?php
            $serialNumber = 1;

            while ($row = $usersResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='py-2 px-4'>" . $serialNumber . "</td>";
                echo "<td class='py-2 px-4'>" . $row['name'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['email'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['password'] . "</td>";
                echo "<td class='py-2 px-4'><a class='text-white p-2 rounded-lg hover:bg-slate-700' href='edit.php?id={$row['id']}'>Edit</a></td>";
                echo "<td class='py-2 px-4'><a class='text-white p-2 rounded-lg hover:bg-slate-700' href='delete.php?id={$row['id']}'>Delete</a></td>"; // Assuming 'id' is the primary key
                echo "</tr>";

                $serialNumber++;
            }
            ?>
        </table>

    </div>
</body>

</html>

<?php
$conn->close();
?>
