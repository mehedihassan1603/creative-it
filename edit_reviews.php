<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0;
    $details = $_POST["details"];
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $photoFileName = $_FILES["photo"]["name"];
        $photoFilePath = "uploads/" . $photoFileName;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photoFilePath)) {
            echo "File uploaded successfully.";
            $insertQuery = $conn->prepare("INSERT INTO reviews (name, photo, rating, details) VALUES (?, ?, ?, ?)");
            $insertQuery->bind_param("ssis", $name, $photoFilePath, $rating, $details);

            if ($insertQuery->execute()) {
                echo " Record added successfully.";
                header("refresh:1;url=admin.php");
            } else {
                echo " Error inserting record into database: " . $insertQuery->error;
            }

            $insertQuery->close();
        } else {
            echo "Error moving uploaded file to destination.";
        }
    } else {
        echo "File upload failed. Error code: " . $_FILES["photo"]["error"];
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews (Editable)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .mt-100 {
            margin-top: 50px;
        }

        .mt-30 {
            margin-top: 30px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

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

<body class="bg-gray-100 flex flex-col">

    <div class="dashboard-container flex flex-col md:flex-row">
        <div class="sidebar bg-gray-900 p-4 h-full md:h-screen w-full md:w-52">
            <div class="sidebar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button"
                        class="bg-gray-400 p-4 rounded-lg hover:border-2 hover:border-white lg:hidden">
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
                                style="display: block; width: 100%; height: 100%;">Front Home</a>
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

                        <div class="dropdown dropdown-right w-full">
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
                                style="display: block; width: 100%; height: 100%;">Admin's</a>
                        </li>
                        <li
                            class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=editable" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Editable Pages</a>
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
                            style="display: block; width: 100%; height: 100%;">Front
                            Home</a>
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

                    <div class="dropdown dropdown-right w-full">
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
                            style="display: block; width: 100%; height: 100%;">Admin's</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?page=editable" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Editable Pages</a>
                    </li>
                    <li
                        class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                        <a href="admin.php?logout=true" class="menu-item"
                            style="display: block; width: 100%; height: 100%;">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="container w-full md:w-9/12 mx-auto p-8">
                <h2 class="text-3xl font-bold mb-4 text-center">Reviews (Editable)</h2>

                <form class="bg-gray-200" method="post" action="" enctype="multipart/form-data">
                    <label for="name" class="block mb-2 font-bold">Name:</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border rounded">

                    <label for="photo" class="block mb-2 font-bold">Photo:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required
                        class="w-full px-4 py-2 mb-4 border rounded">

                    <label for="rating" class="block mb-2 font-bold">Rating:</label>
                    <div class="rating">
                        <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-green-500" />
                        <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-green-500" />
                        <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-green-500" />
                        <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-green-500" />
                        <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-green-500" checked />
                    </div>

                    <label for="details" class="block mb-2 font-bold">Details:</label>
                    <textarea id="details" name="details" required
                        class="w-full px-4 py-2 mb-4 border rounded"></textarea>

                    <input type="submit" value="Save Changes"
                        class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer">
                </form>
            </div>
            <?php include 'reviews.php' ?>
        </div>
    </div>


</body>

</html>