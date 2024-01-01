<?php
include 'config.php';

$per_page = 4;
$start = 0;
$current_page = 1;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
    if ($start <= 0) {
        $start = 0;
        $current_page = 1;
    } else {
        $current_page = $start;
        $start--;
        $start = $start * $per_page;
    }
}
$usersQuery = "SELECT id, name, photo, details, rating FROM reviews LIMIT $start, $per_page";
$usersResult = $conn->query($usersQuery);
$record = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reviews"));
$pagi = ceil($record / $per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-800 text-white">

    <div class="container bg-gray-300 mx-auto p-8">
        <h3 class="text-3xl text-center mt-4">All Reviews</h3>

        <div class="overflow-x-auto">
            <table class="mt-4 mx-auto">
                <tr>
                    <th class="bg-green-500 text-white py-2 px-4">Serial Number</th>
                    <th class="bg-green-500 text-white py-2 px-4">Name</th>
                    <th class="bg-green-500 text-white py-2 px-4">Photo</th>
                    <th class="bg-green-500 text-white py-2 px-4">Details</th>
                    <th class="bg-green-500 text-white py-2 px-4">Rating</th>
                    <th class="bg-green-500 text-white py-2 px-4">Delete</th>
                </tr>

                <?php
                $serialNumber = $start + 1;

                while ($row = $usersResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='py-2 px-4'>" . $serialNumber . "</td>";
                    echo "<td class='py-2 px-4'>" . $row['name'] . "</td>";
                    echo "<td class='py-2 px-4'>" . $row['photo'] . "</td>";
                    echo "<td class='py-2 px-4'>" . $row['details'] . "</td>";
                    echo "<td class='py-2 px-4'>" . $row['rating'] . "</td>";
                    echo "<td class='py-2 px-4'><a class='text-black p-2 rounded-lg hover:bg-slate-700' href='delete_reviews.php?id={$row['id']}'>Delete</a></td>"; // Assuming 'id' is the primary key
                    echo "</tr>";

                    $serialNumber++;
                }
                ?>
            </table>
        </div>

        <ul class="flex gap-5 mt-3">
            <?php for ($i = 1; $i <= $pagi; $i++): ?>
                <?php
                $class = $current_page == $i ? 'bg-green-600 cursor-pointer px-2 py-2 active hover:bg-green-800' : 'page-item p-2 cursor-pointer hover:bg-green-800 hover:p-2';
                ?>
                <li class="<?php echo $class; ?>">
                    <a class="page-link" href="<?= $class === 'active' ? 'javascript:void(0)' : "?start={$i}" ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>

    </div>
</body>

</html>

<?php
$conn->close();
?>
