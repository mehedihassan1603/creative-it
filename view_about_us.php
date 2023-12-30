<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM about ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
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
    <title>About Us</title>
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
                    <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                    <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
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
        <h2 class="text-3xl font-bold mb-4 text-center">About Us</h2>

        <div class="bg-white p-6 text-center rounded-md shadow-md">
            <h3 class="text-2xl font-bold mb-2">
                <?= $name ?>
            </h3>
            <p class="text-lg text-gray-600 font-semibold mb-2">
                <?= $designation ?>
            </p>
            <p class="text-gray-800 mt-2 w-full md:w-2/4 mx-auto text-start">
                <?= $details ?>
            </p>
        </div>

    </div>

</body>

<?php
include 'footer.php';
?>

</html>