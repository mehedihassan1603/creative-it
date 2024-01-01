<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['course_submit'])) {
        $name = $_POST['new_course'];

        $checkQuery = "SELECT * FROM courses WHERE course_name = '$name'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo '<div id="error-alert" class="bg-red-200 text-red-800 p-4 rounded mt-4">
                <h1>Course Name already exists!</h1>
            </div>';
        } else {
            $sqli = "INSERT INTO `courses` (`course_name`) VALUES ('$name')";

            if (mysqli_query($conn, $sqli)) {
                echo '<div id="success-alert" class="bg-green-200 text-green-800 p-4 rounded mt-4">
                    <h1>New Course Inserted Successfully!</h1>
                </div>';
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "/cit/admin.php?page=add_option";
                        }, 1000);
                      </script>';
                exit();
            } else {
                echo "Not Inserted";
            }
        }
    }

    if (isset($_POST['delete_course'])) {
        $deleteId = $_POST['delete_course'];
        $deleteQuery = "DELETE FROM `courses` WHERE `id` = $deleteId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<div id="success-alert" class="bg-green-200 text-green-800 p-4 rounded mt-4">
                <h1>Deleted Successfully!</h1>
            </div>';
        } else {
            echo "Not Delete";
        }
    }
}

$result = mysqli_query($conn, "SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-slate-800">
    <div class="p-8 rounded w-full lg:w-2/4 mx-auto shadow-md">
        <form action="" method="POST">
            <div class="mb-4">
                <label for="course_name" class="block text-2xl text-center mb-5 font-bold text-gray-700">Add New Course
                    Name</label>
                <input type="text" id="new_course" name="new_course"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                    placeholder="Add New Course" required>
            </div>
            <button type="submit" name="course_submit"
                class="bg-blue-500 w-full text-center text-white px-6 py-2 rounded cursor-pointer">Add New
            </button>
        </form>
    </div>
    <div id="success-alert" class="hidden bg-green-200 text-green-800 p-4 rounded mt-4">
        <h1>New Course Inserted Successfully!</h1>
    </div>
    <div class="mt-4">
        <h2 class="text-2xl text-white text-center font-bold mb-2">All Course List</h2>
        <table class="min-w-full bg-white text-center border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Serial</th>
                    <th class="py-2 px-4 border-b">Course Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                    <td class="py-2 px-4 border-b">' . $serial . '</td>
                    <td class="py-2 px-4 border-b">' . $row['course_name'] . '</td>
                    <td class="py-0 px-0 border-b">
                        <form action="" method="POST">
                            <input type="hidden" name="delete_course" value="' . $row['id'] . '">
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
        if (isset($_POST['course_submit']) && mysqli_query($conn, $sqli)) {
            echo 'document.getElementById("success-alert").classList.remove("hidden");';
        }
        ?>
    </script>
</body>

</html>
