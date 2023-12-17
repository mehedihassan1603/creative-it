<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .dashboard-container {
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            padding: 20px;
            color: white;
            height: 100vh;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
        }

        .sidebar a:hover {
            color: #ffd700;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            max-width: 100%;
        }

        .content h2 {
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="dashboard-container">
        <div class="sidebar">
            <ul>
                <li><a href="admin.php?page=dashboard">Home</a></li>
                <li><a href="admin.php?page=addStudents">Add Student</a></li>
                <li><a href="admin.php?page=logo">Add Logo</a></li>
                <li><a href="admin.php?page=certificate_list">Certificate List</a></li>
            </ul>
        </div>
        <div class="content">
            <?php
            // Check if a page is specified in the URL, otherwise default to home
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            // Include the corresponding PHP file based on the selected page
            $filename = $page . '.php';
            if (file_exists($filename)) {
                include($filename);
            } else {
                echo 'Page not found';
            }
            ?>
        </div>
    </div>

</body>

</html>