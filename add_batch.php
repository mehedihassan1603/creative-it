<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['batch_submit'])) {
        $batchName = $_POST['new_batch'];

        $checkQuery = "SELECT * FROM batches WHERE batch_name = '$batchName'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo '<div id="error-alert" class="bg-red-200 text-red-800 p-4 rounded mt-4">
                <h1>Batch Name already exists!</h1>
            </div>';
        } else {
            $sql = "INSERT INTO `batches` (`batch_name`) VALUES ('$batchName')";

            if (mysqli_query($conn, $sql)) {
                echo '<div id="success-alert" class="bg-green-200 text-green-800 p-4 rounded mt-4">
                    <h1>New Batch Inserted Successfully!</h1>
                </div>';
                echo '<script>
                    setTimeout(function(){
                        window.location.href = "/cit/admin.php?page=add_batch";
                    }, 1000);
                  </script>';
                exit();
            } else {
                echo "Not Inserted";
            }
        }
    }

    if (isset($_POST['delete_batch'])) {
        $deleteId = $_POST['delete_batch'];
        $deleteQuery = "DELETE FROM `batches` WHERE `id` = $deleteId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<div id="success-alert" class="bg-green-200 text-green-800 p-4 rounded mt-4">
                <h1>Batch Deleted Successfully!</h1>
            </div>';
        } else {
            echo "Not Deleted";
        }
    }
}
$result = mysqli_query($conn, "SELECT * FROM batches");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Batch</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-slate-800">
    <div class="p-8 rounded w-full lg:w-2/4 mx-auto shadow-md">
        <form action="" method="POST">
            <div class="mb-4">
                <label for="batch_name" class="block text-2xl text-center mb-5 font-bold text-gray-700">Add New Batch
                    Name</label>
                <input type="text" id="new_batch" name="new_batch"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                    placeholder="Add New Batch" required>
            </div>
            <button type="submit" name="batch_submit"
                class="bg-blue-500 w-full text-center text-white px-6 py-2 rounded cursor-pointer">Add New
                Batch
            </button>
        </form>
    </div>
    <div id="success-alert" class="hidden bg-green-200 text-green-800 p-4 rounded mt-4">
        <!-- Success message will appear here -->
    </div>
    <div class="mt-4">
        <h2 class="text-2xl text-white text-center font-bold mb-2">All Batch List</h2>
        <table class="min-w-full bg-white text-center border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Serial</th>
                    <th class="py-2 px-4 border-b">Batch Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                    <td class="py-2 px-4 border-b">' . $serial . '</td>
                    <td class="py-2 px-4 border-b">' . $row['batch_name'] . '</td>
                    <td class="py-0 px-0 border-b">
                        <form action="" method="POST">
                            <input type="hidden" name="delete_batch" value="' . $row['id'] . '">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300">Delete</button>
                        </form>
                    </td>
                </tr>';
                    $serial++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        <?php
        if (isset($_POST['batch_submit']) && mysqli_query($conn, $sql)) {
            echo 'document.getElementById("success-alert").classList.remove("hidden");';
        }
        ?>
    </script>
</body>

</html>
