<?php

include 'config.php';

$sql = "SELECT * FROM reviews ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);

$sqla = "SELECT * FROM about ORDER BY id DESC LIMIT 1";
$resulta = $conn->query($sqla);

if ($resulta->num_rows > 0) {
    $row = $resulta->fetch_assoc();
    $name = $row['name'];
    $designation = $row['designation'];
    $details = $row['details'];
} else {
    $name = "No data found";
    $designation = "";
    $details = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-black rounded-box w-52">
                    <li class="mr-4"><a href="index.php" class="text-white bg-slate-700">Home</a></li>
                    <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                    <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                    <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
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
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </div>

    <!-- <nav class="flex justify-between items-center bg-gray-800 text-white p-4">
        <div>
            <img src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo" width="80px">
        </div>
        <div>
            <ul class="flex">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </nav> -->

    <?php
    include 'banner.php';
    ?>

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4 text-center">About Us</h2>

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-2/4">
                <img src="https://static.vecteezy.com/system/resources/previews/021/389/011/original/about-us-button-web-template-speech-bubble-banner-label-about-us-sign-icon-illustration-vector.jpg"
                    alt="">
            </div>
            <div class="bg-gray-100 p-6 text-center w-full md:w-2/4 rounded-md shadow-md">
                <h3 class="text-2xl font-bold mb-2">
                    <?= $name ?>
                </h3>
                <p class="text-lg text-gray-600 font-semibold mb-2">
                    <?= $designation ?>
                </p>
                <p class="text-gray-800 text-lg mt-2 w-full md:w-3/4 mx-auto text-start">
                    <?= $details ?>
                </p>
            </div>
        </div>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>

<?php
$conn->close();
?>