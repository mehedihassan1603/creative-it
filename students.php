<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h3 {
            margin-top: 20px;
            text-align: center;
            font-size: 38px;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            overflow-x: auto;
        }

        table,
        th,
        td {
            border: 2px solid #ddd;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div>
        <?php
        $totalRecordsQuery = "SELECT COUNT(*) as total_records FROM students";
        $totalRecordsResult = $conn->query($totalRecordsQuery);
        $totalRecords = $totalRecordsResult->fetch_assoc()['total_records'];

        $totalCertificatesQuery = "SELECT COUNT(DISTINCT certificate_id) as total_certificates FROM students";
        $totalCertificatesResult = $conn->query($totalCertificatesQuery);
        $totalCertificates = $totalCertificatesResult->fetch_assoc()['total_certificates'];

        $studentsQuery = "SELECT * FROM students";
        $studentsResult = $conn->query($studentsQuery);
        ?>
        <h3>Students Information</h3>
        <table>
            <tr>
                <th>Certificate ID</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Mother's Name</th>
                <th>Course Name</th>
                <th>Batch Number</th>
                <th>Course End Date</th>
                <th>Certificate Date</th>
            </tr>

            <?php
            while ($row = $studentsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['certificate_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['father_name'] . "</td>";
                echo "<td>" . $row['mother_name'] . "</td>";
                echo "<td>" . $row['course_name'] . "</td>";
                echo "<td>" . $row['batch_number'] . "</td>";
                echo "<td>" . $row['course_end_date'] . "</td>";
                echo "<td>" . $row['certificate_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>