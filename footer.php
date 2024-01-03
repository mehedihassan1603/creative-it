<?php
include 'config.php';

$query = "SELECT * FROM information ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $facebook = $row['facebook'];
    $phone = $row['phone'];
    $youtube = $row['gmail'];
    $linkdin = $row['linkdin'];
    $develop = $row['develop'];
} else {
    echo "Error: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/72d0103d4a.js" crossorigin="anonymous"></script>
</head>

<body>
    <footer class="footer p-10 bg-slate-500 text-base-content text-white">
        <aside class="flex flex-col justify-center items-center">
            <img class="bg-white w-16 ml-4 rounded-full" src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo">
            <?php echo "<span class='font-semibold text-white'>" . $name . "</span>"; ?>
            <div class="flex gap-4">
                <a href="<?php echo htmlspecialchars($facebook); ?>" target="_blank"><i
                        class="fab fa-facebook text-white text-xl"></i></a>
                <a href="<?php echo htmlspecialchars($youtube); ?>" target="_blank"><i
                        class="fab fa-youtube text-white text-xl"></i></a>
                <a href="<?php echo htmlspecialchars($linkdin); ?>" target="_blank"><i
                        class="fab fa-linkedin text-white text-xl"></i></a>
            </div>

        </aside>

        <nav>
            <header class="text-xl text-white">Company</header>
            <a href="view_about_us.php" class="link link-hover text-white">About us</a>
        </nav>
        <nav>
            <header class="text-xl text-white">Legal</header>
            <a href="view_terms.php" class="link link-hover text-white">Terms of use</a>
            <a href="view_privacy.php" class="link link-hover text-white">Privacy policy</a>
        </nav>

    </footer>
    <div class="px-10 text-white flex justify-between bg-slate-500">
        <div>&copy;
            <?php echo date("Y "); ?> By
            <?php echo "<span class='font-semibold'>" . $name . "</span>"; ?>
            . All rights reserved.
        </div>

        <div class="text-sm">
            Design & Develop by
            <?php echo "<span class='font-semibold'>" . $develop . "</span>"; ?>
        </div>

    </div>
</body>

</html>