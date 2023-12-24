<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <nav class="flex justify-between items-center bg-gray-800 text-white p-4">
        <div>
            <img src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo" width="80px">
        </div>
        <div>
            <ul class="flex">
                <li class="mr-4"><a href="#" class="text-white">Home</a></li>
                <li class="mr-4"><a href="#" class="text-white">About</a></li>
                <li class="mr-4"><a href="#" class="text-white">Service</a></li>
                <li><a href="#" class="text-white">Contact</a></li>
            </ul>
        </div>
        <div>
            <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-red-700"><a href="admin.php" class="text-white">Admin</a></button>
        </div>
    </nav>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedSearchType = $_POST['searchType'];

        switch ($selectedSearchType) {
            case 'search':
                $formAction = 'search.php';
                break;
            case 'search_sec':
                $formAction = 'search_sec.php';
                break;
            default:
                $formAction = '';
                break;
        }
    } else {
        $formAction = '';
    }
    ?>

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Search by ID:</h2>
        <form id="searchForm" method="get" action="<?php echo $formAction; ?>" class="mt-4">
            <label for="searchId" class="block font-bold mb-2">Enter ID:</label>
            <input type="text" id="searchId" name="certificate_id" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded mt-4 hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
                Search
            </button>
        </form>
    </div>

</body>

</html>
