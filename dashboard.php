<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #585555;

            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .content {
            padding: 20px;
            max-width: 100%;
            width: 100%;
            color: white;
        }

        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .statistics-box {
            background-color: #3498db;
            color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .statistics-box p {
            margin: 0;
            font-size: 18px;
        }

        h3 {
            margin-top: 20px;
            text-align: center;
            font-size: 38px;
        }

        table {
            width: 100%;
            max-width: 100%;
            /* Set max-width to limit the table width */
            margin-top: 10px;
            border-collapse: collapse;
            overflow-x: auto;
            /* Add overflow-x property for horizontal scrolling */
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

        .state-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }


        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            .statistics-box {
                padding: 15px;
                font-size: 16px;
            }

            h3 {
                font-size: 16px;
            }

            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
    <title>Statistics</title>
</head>

<body>

    <div class="content">
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

        <div class="state-container">
            <div class="statistics-box">
                <p>Total Number of Records</p>
                <h3>
                    <?php echo $totalRecords; ?>
                </h3>
            </div>

            <div class="statistics-box">
                <p>Total Number of Certificates</p>
                <h3>
                    <?php echo $totalCertificates; ?>
                </h3>
            </div>
        </div>

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