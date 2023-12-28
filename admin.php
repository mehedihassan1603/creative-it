<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
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

            width: 100%;
        }

        .sidebar {

            background-color: #333;
            padding: 20px;
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
    <div class="dashboard-container flex flex-col md:flex-row">
        <!-- <div class="sidebar bg-gray-900 p-4 h-screen w-full md:w-52">
            <ul class="space-y-2">
                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="index.php" class="menu-item" style="display: block; width: 100%; height: 100%;">Home</a>
                </li>

                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?page=dashboard" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">Profile</a>
                </li>
                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?page=add_option" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">All Courses</a>
                </li>
                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?page=add_batch" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">All Batches</a>
                </li>

                <div class="dropdown dropdown-right">
                    <li tabindex="0" role=""
                        class="menu-item bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white"
                        style="display: block; width: 100%; height: 100%;">
                        Manage Students
                    </li>
                    <ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-200 p-4 rounded-box w-52">
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=addStudents" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Add Students</a>
                        </li>
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=students" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">View Students</a>
                        </li>
                    </ul>
                </div>

                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?page=users" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">Users</a>
                </li>
                <li <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?page=certificate_list" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">New Certificate</a>
                </li>
                <li
                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                    <a href="admin.php?logout=true" class="menu-item"
                        style="display: block; width: 100%; height: 100%;">Log Out</a>
                </li>
            </ul>
        </div> -->

        <div class="sidebar bg-gray-900 p-4 h-full md:h-screen w-full md:w-52">
            <div class="sidebar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="index.php" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Home</a>
                        </li>

                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=dashboard" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Profile</a>
                        </li>
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=add_option" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">All Courses</a>
                        </li>
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=add_batch" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">All Batches</a>
                        </li>

                        <div class="dropdown dropdown-right">
                            <li tabindex="0" role=""
                                class="menu-item mb-2 bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white"
                                style="display: block; width: 100%; height: 100%;">
                                Manage Students
                            </li>
                            <ul tabindex="0"
                                class="dropdown-content z-[1] menu shadow bg-base-200 p-4 rounded-box w-52">
                                <li
                                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                                    <a href="admin.php?page=addStudents" class="menu-item"
                                        style="display: block; width: 100%; height: 100%;">Add Students</a>
                                </li>
                                <li
                                    class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                                    <a href="admin.php?page=pagination" class="menu-item"
                                        style="display: block; width: 100%; height: 100%;">View Students</a>
                                </li>
                            </ul>
                        </div>

                        <li
                            class="bg-zinc-300 mt-2 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=users" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Users</a>
                        </li>
                        <li <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=certificate_list" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">New Certificate</a>
                        </li>
                        <li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?logout=true" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="index.php" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Home</a>
                    </li>

                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=dashboard" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Profile</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=add_option" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">All Courses</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=add_batch" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">All Batches</a>
                    </li>

                    <div class="dropdown dropdown-right">
                        <li tabindex="0" role=""
                            class="menu-item bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white"
                            style="display: block; width: 100%; height: 100%;">
                            Manage Students
                        </li>
                        <ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-200 p-4 rounded-box w-52">
                            <li
                                class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                                <a href="admin.php?page=addStudents" class="menu-item"
                                    style="display: block; width: 100%; height: 100%;">Add Students</a>
                            </li>
                            <li
                                class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                                <a href="pagination/index.php" class="menu-item"
                                    style="display: block; width: 100%; height: 100%;">View Students</a>
                            </li>
                        </ul>
                    </div>

                    <li
                        class="bg-zinc-300 w-full mt-2 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=users" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Users</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=certificate_list" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">New Certificate</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?logout=true" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
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