<?php
include 'config.php';

$sql = "SELECT * FROM reviews ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
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
                    <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
                    <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_about_us.php" class="text-white">About</a></li>
                <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div tabindex="0" role="button" class="bg-orange-600 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogin.php">Login</a></div>
        </div>
    </div>

    <div class="container mx-auto p-8 mt-10 h-full overflow-x-hidden">
        <h2 class="text-3xl text-center font-bold mb-4">All Reviews</h2>

        <div class="swiper-container w-full">
            <div class="swiper-wrapper">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $photo = $row['photo'];
                        $rating = $row['rating'];
                        $details = $row['details'];

                        echo '<div class="swiper-slide w-ful">';
                        echo '<div class="mb-8 flex flex-col justify-center items-center">';
                        echo '<img src="' . $photo . '" alt="User Photo" class="rounded-full h-16 w-16 md:h-24 md:w-24 object-cover mb-2">';
                        echo '<h3 class="text-base md:text-xl font-bold mb-2">' . $name . '</h3>';
                        echo '<div class="rating w-3/4 md:w-11/12 flex justify-center ">';
                        for ($i = 1; $i <= 5; $i++) {
                            $checked = $i <= $rating ? 'checked' : '';
                            echo '<input type="radio" name="rating-' . $name . '" class="mask mask-star-2 bg-green-500" ' . $checked . ' />';
                        }
                        echo '</div>';
                        echo '<p class="text-gray-800 text-sm md:text-base">' . $details . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center text-gray-600">No reviews available.</p>';
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>

    <div class="mt-10">
    <?php include 'footer.php'; ?>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });
    </script>

</body>

</html>