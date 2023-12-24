<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle filter submissions
$filterCertificateId = isset($_POST['filter_certificate_id']) ? $_POST['filter_certificate_id'] : '';
$filterCourseName = isset($_POST['filter_course_name']) ? $_POST['filter_course_name'] : '';

// Build the WHERE clause based on the filters
$whereClause = "WHERE 1"; // default WHERE condition

if ($filterCertificateId !== '') {
    $whereClause .= " AND certificate_id = '$filterCertificateId'";
}

if ($filterCourseName !== '') {
    $whereClause .= " AND course_name = '$filterCourseName'";
}

$studentsQuery = "SELECT * FROM students $whereClause";
$studentsResult = $conn->query($studentsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-800 text-white">

    <div class="container mx-auto p-8">
        <?php
        $totalRecordsQuery = "SELECT COUNT(*) as total_records FROM students";
        $totalRecordsResult = $conn->query($totalRecordsQuery);
        $totalRecords = $totalRecordsResult->fetch_assoc()['total_records'];

        $totalCertificatesQuery = "SELECT COUNT(DISTINCT certificate_id) as total_certificates FROM students";
        $totalCertificatesResult = $conn->query($totalCertificatesQuery);
        $totalCertificates = $totalCertificatesResult->fetch_assoc()['total_certificates'];
        ?>
        <h3 class="text-3xl text-center mt-4">Students Information</h3>

        <!-- Filter Form -->
        <form method="post" class="mt-8 mb-4 bg-gray-500 text-center">
            <div class="flex justify-center space-x-4">
                <div>
                    <label for="filter_certificate_id" class="block text-white">Filter by Certificate ID:</label>
                    <input type="text" id="filter_certificate_id" name="filter_certificate_id"
                        value="<?= $filterCertificateId ?>"
                        class="px-4 py-2 border rounded bg-gray-700 text-white">
                </div>

                <div>
                    <label for="filter_course_name" class="block text-white">Filter by Course Name:</label>
                    <select id="filter_course_name" name="filter_course_name"
                        class="px-4 py-2 border rounded bg-gray-700 text-white">
                        <option value="" <?= $filterCourseName === '' ? 'selected' : '' ?>>All</option>

                        <?php
                        $courseQuery = "SELECT DISTINCT course_name FROM students";
                        $courseResult = $conn->query($courseQuery);

                        while ($row = $courseResult->fetch_assoc()) {
                            $selected = ($filterCourseName === $row['course_name']) ? 'selected' : '';
                            echo "<option value='{$row['course_name']}' $selected>{$row['course_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <input type="submit" value="Apply Filters"
                        class="px-4 py-2 mt-6 bg-green-500 text-white rounded cursor-pointer">
                </div>
            </div>
        </form>

        <!-- Display Filtered Students -->
        <table class="w-full mt-4">
            <tr>
                <th class="bg-green-500 text-white py-2 px-4">Certificate ID</th>
                <th class="bg-green-500 text-white py-2 px-4">Name</th>
                <th class="bg-green-500 text-white py-2 px-4">Father's Name</th>
                <th class="bg-green-500 text-white py-2 px-4">Mother's Name</th>
                <th class="bg-green-500 text-white py-2 px-4">Course Name</th>
                <th class="bg-green-500 text-white py-2 px-4">Batch Number</th>
                <th class="bg-green-500 text-white py-2 px-4">Course End Date</th>
                <th class="bg-green-500 text-white py-2 px-4">Certificate Date</th>
                <th class="bg-green-500 text-white py-2 px-4">Edit</th>
                <th class="bg-green-500 text-white py-2 px-4">Delete</th>
            </tr>

            <?php
            while ($row = $studentsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='py-2 px-4'>" . $row['certificate_id'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['name'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['father_name'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['mother_name'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['course_name'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['batch_number'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['course_end_date'] . "</td>";
                echo "<td class='py-2 px-4'>" . $row['certificate_date'] . "</td>";
                echo "<td class='py-2 px-4'><a href='edit.php?id={$row['id']}'>Edit</a></td>";
                echo "<td class='py-2 px-4'><a href='delete.php?id={$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

