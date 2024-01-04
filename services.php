<?php
include 'config.php';

$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching courses: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Section</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <style>
        .zoom:hover {
            transform: scale(1.05); 
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-slate-600 flex flex-col">
    <div class="dashboard-container flex flex-col md:flex-row">
        <div class="w-full mx-auto bg-white rounded p-8 shadow-md">
            <h2 class="text-4xl text-center font-semibold mb-4">Our Services</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <a href="<?php echo htmlspecialchars($row['website']); ?>" class="bg-slate-600 flex flex-row pl-10 cursor-pointer py-5 md:py-10 rounded-md zoom hover:zoom">
                        <div class=""><img class="bg-white w-20 md:w-28 rounded-full" src="<?php echo htmlspecialchars($row['photo']); ?>" alt=""></div>
                        <h3 class="text-lg flex flex-col ml-10 justify-center font-semibold text-center text-white"><?php echo htmlspecialchars($row['course_name']); ?></h3>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>

</html>
