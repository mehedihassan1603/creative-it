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
                    <div class="bg-slate-600 cursor-pointer p-4 rounded-md zoom hover:zoom">
                        <h3 class="text-lg font-semibold mb-2 py-10 text-center text-white"><?php echo htmlspecialchars($row['course_name']); ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>

</html>
