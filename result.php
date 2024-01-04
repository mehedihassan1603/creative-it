<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="navbar bg-gray-900 p-4 w-full md:w-52">
        <div class="navbar-start">
            <div class="hidden md:block">
                <img src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo" width="80px">
            </div>
            <div class="dropdown">
                <div tabindex="0" role="button"
                    class="bg-gray-400 p-4 rounded-lg hover:border-2 hover:border-white md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-black rounded-box w-52">
                    <li class="mr-4"><a href="index.php" class="text-white bg-slate-700">Home</a></li>
                    <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                    <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                    <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </div>

    <div>
        <h1 class="text-white bg-slate-700 text-center rounded-lg py-3 text-2xl">Search by ID:</h1>
        <div class="flex flex-col md:flex-row justify-center gap-10">
            <div>
                <img src="https://img.myloview.cz/plakaty/pie-graph-400-320120914.jpg" alt="">
            </div>
            <div>
                <div class="max-w-md mx-auto bg-slate-700 rounded-lg p-8 mt-0 md:mt-20 ">
                    <form id="searchForm" method="get" action="search.php" class="mt-2 bg-gray-400 rounded-lg">
                        <label for="searchId"
                            class="block font-bold mb-2 text-center text-xl">Enter
                            ID:</label>
                        <input type="text" id="searchId" name="certificate_id" required
                            class="w-full px-4 py-2 text-black border rounded focus:outline-none focus:border-blue-500">
                        <button type="submit"
                            class="bg-red-500 text-center w-full z-10 text-white px-4 py-2 rounded mt-4 hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>

</html>