<?php
include 'config.php';

$sql = "SELECT * FROM contact ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $map = $row['map'];
} else {
    $name = "No data found";
    $email = "";
    $phone = "";
    $address = "";
    $map = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
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
                    <li class="mr-4"><a href="view_about_us.php" class="text-white">About Us</a></li>
                    <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                    <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_about_us.php" class="text-white">About Us</a></li>
                <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </div>

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4 text-center">Contact Us</h2>

        <div class="bg-gray-200 p-6 text-center rounded-md shadow-md">
            <div class="flex justify-center">
                <img class="bg-white w-48 rounded-full" src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo"
                    width="80px">
            </div>
            <h3 class="text-2xl font-bold mb-2 mt-4">
                <?= $name ?>
            </h3>
            <div class="flex justify-center gap-10 mt-10">
                <div class="text-lg text-gray-600 font-semibold mb-2 flex gap-4 ">
                    <img class="bg-white w-16 h-16 rounded-full"
                        src="https://png.pngtree.com/png-vector/20190927/ourmid/pngtree-email-icon-png-image_1757854.jpg?<?php echo time(); ?>"
                        alt="Logo">
                    <div class="flex flex-col">
                        <h1>Email:</h1>
                        <p>
                            <?= $email ?>
                        </p>
                    </div>
                </div>
                <div class="text-lg text-gray-600 font-semibold mb-2 flex gap-4 ">
                    <img class="bg-white w-16 h-16 rounded-full"
                        src="https://e7.pngegg.com/pngimages/620/23/png-clipart-phone-phone-thumbnail.png?<?php echo time(); ?>"
                        alt="Logo">
                    <div class="flex flex-col">
                        <h1>Phone Number:</h1>
                        <p>
                            <?= $phone ?>
                        </p>
                    </div>
                </div>
                <div class="text-lg text-gray-600 font-semibold mb-2 flex gap-4 ">
                    <img class="bg-white w-16 h-16 rounded-full"
                        src="https://icons.veryicon.com/png/o/internet--web/industrial-icon/address-3.png?<?php echo time(); ?>"
                        alt="Logo">
                    <div class="flex flex-col">
                        <h1>Address:</h1>
                        <p>
                            <?= $address ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center bg-gray-500">
            <div class="map-wrapper" id="mapwrapper">
            <?= $map ?>
            </div>
        </div>

    </div>

</body>

<?php
include 'footer.php';
?>

</html>