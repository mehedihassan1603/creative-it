<?php
include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$usersQuery = "SELECT id, name, email, password FROM users";
$usersResult = $conn->query($usersQuery);

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
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
        <h3 class="text-3xl text-center mt-4">Admin Information</h3>
        <div class="text-end w-7/12 mx-auto "><a class="py-2 bg-indigo-500 px-1 rounded-md hover:bg-indigo-600" href="signup.php">Create New Admin</a></div>
        <div class="overflow-x-auto">
            <table class="mt-4 mx-auto">
                <thead>
                    <tr>
                        <th class="bg-green-500 text-white py-2 px-4">Serial Number</th>
                        <th class="bg-green-500 text-white py-2 px-4">Name</th>
                        <th class="bg-green-500 text-white py-2 px-4">Email</th>
                        <th class="bg-green-500 text-white py-2 px-4">Edit</th>
                        <th class="bg-green-500 text-white py-2 px-4">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serialNumber = 1;

                    while ($row = $usersResult->fetch_assoc()) {
                        $rowColorClass = $serialNumber % 2 === 0 ? 'bg-slate-600' : 'bg-cyan-600';
                        echo "<tr class='$rowColorClass'>";
                        echo "<td class='py-2 px-4'>" . $serialNumber . "</td>";
                        echo "<td class='py-2 px-4'>" . $row['name'] . "</td>";
                        echo "<td class='py-2 px-4'>" . $row['email'] . "</td>";
                        echo "<td class='py-2 px-4'><a class='text-white p-2 rounded-lg hover:bg-slate-700' href='edit_admin.php?id={$row['id']}'>Edit</a></td>";
                        echo "<td class='py-2 px-4'><a class='text-white p-2 rounded-lg hover:bg-slate-700' href='delete_admin.php?id={$row['id']}'>Delete</a></td>"; // Assuming 'id' is the primary key
                        echo "</tr>";
                        $serialNumber++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>
