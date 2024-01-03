<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include 'config.php';

$query = "SELECT * FROM information ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $companyName = $row['name'];
    $facebook = $row['facebook'];
    $linkedin = $row['linkdin'];
    $youtube = $row['gmail'];
    $phone = $row['phone'];
    $develop = $row['develop'];
} else {
    
}

mysqli_close($conn);
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
        <div class="w-3/6 mx-auto bg-white rounded p-8 shadow-md">
            <h2 class="text-2xl text-center font-semibold mb-4">Company Information</h2>
            <form class="bg-gray-300" action="information_submit.php" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-black">Company Name:</label>
                    <input type="text" name="name" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($companyName) ? htmlspecialchars($companyName) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label for="facebook" class="block text-lg font-medium text-black">Facebook:</label>
                    <input type="text" name="facebook" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($facebook) ? htmlspecialchars($facebook) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label for="linkdin" class="block text-lg font-medium text-black">LinkedIn:</label>
                    <input type="text" name="linkdin" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($linkedin) ? htmlspecialchars($linkedin) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label for="gmail" class="block text-lg font-medium text-black">Youtube:</label>
                    <input type="email" name="gmail" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($youtube) ? htmlspecialchars($youtube) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-lg font-medium text-black">Phone Number:</label>
                    <input type="number" name="phone" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label for="develop" class="block text-lg font-medium text-black">Design by:</label>
                    <input type="text" name="develop" class="mt-1 p-2 w-full border rounded-md" value="<?php echo isset($develop) ? htmlspecialchars($develop) : ''; ?>">
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-700">Update Information</button>
            </form>
        </div>
    </div>
</body>

</html>