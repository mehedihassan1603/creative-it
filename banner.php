<?php

include 'config.php';

$query = "SELECT * FROM information ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $phone = $row['phone'];
    $photo = $row['photo'];
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- <section class="bg-indigo-800 text-white py-16">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Your Website</h1>
            <p class="text-lg mb-8">Discover amazing experiences with us</p>
            <a href="#" class="bg-white text-indigo-800 py-2 px-6 rounded-full text-lg font-semibold hover:bg-indigo-700 transition duration-300">Explore Now</a>
        </div>
    </section> -->

    <div class="w-full">
        <div id="slide1" class="relative w-full h-2/4">
            <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" class="w-full h-[250px] md:h-[400px] lg:h-[500px]" />
            
        </div>
        <!-- <div id="slide2" class="carousel-item relative w-full">
            <img src="./uploads/graphics.jpg" class="w-full h-[250px] md:h-[400px] lg:h-[500px]" />
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide1" class="btn btn-circle">❮</a>
                <a href="#slide1" class="btn btn-circle">❯</a>
            </div>
        </div> -->
        
    </div>

</body>

</html>