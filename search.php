<?php
// include 'navbar.php';
include 'config.php';

require 'vendor/autoload.php';

include 'src/QRCode.php';
include 'src/QROptions.php';

session_start();

if (isset($_GET['style'])) {
    $_SESSION['certificate_style'] = $_GET['style'];
}
$selectedStyle = isset($_SESSION['certificate_style']) ? $_SESSION['certificate_style'] : 'default';

$searchId = $_GET['certificate_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE certificate_id = ?");
$stmt->bind_param("s", $searchId);
$stmt->execute();
$result = $stmt->get_result();


$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>
<style>
    .myElement {
        position: absolute;
        top: 60%;
        left: 22%;
        transform: translate(-50%, -50%);
        color: black;
    }

    .iddate {
        position: absolute;
        top: 45%;
        left: 20%;
        transform: translate(-50%, -50%);
        color: black;
    }

    .present {
        display: block;
        position: absolute;
        top: 42%;
        left: 45.5%;
        transform: translate(-50%, -50%);
        color: black;
        font-size: 2em;
        width: 400px;
    }
    .text {
        position: absolute;
        top: 48%;
        left: 53.7%;
        transform: translate(-50%, -50%);
        color: black;
    }
    

    @media only screen and (max-width: 767px) {
        .myElement {
            top: 70%;
            left: 35%;
            transform: translate(-50%, -50%);
            color: blue;
        }

        .iddate {
            top: 47%;
            left: 22%;
            transform: translate(-50%, -50%);
            color: black;
        }
        .present {
        display: block;
        position: absolute;
        top: 40%;
        left: 80%;
        transform: translate(-50%, -50%);
        color: black;
        font-size: 2em;
        width: 400px;
    }
    .text {
        position: absolute;
        top: 55%;
        left: 55.7%;
        transform: translate(-50%, -50%);
        color: black;
    }
    }
</style>

<body>
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
                    <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
                    <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-4"><a href="index.php" class="text-white">Home</a></li>
                <li class="mr-4"><a href="view_reviews.php" class="text-white">Reviews</a></li>
                <li class="mr-4"><a href="view_contact.php" class="text-white">Contact</a></li>
                <li class="mr-4"><a href="result.php" class="text-white">Find Result</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <div tabindex="0" role="button" class="bg-orange-200 px-4 py-2 rounded-lg m-1 hover:bg-orange-700"><a
                    href="studentLogout.php">Logout</a></div>
        </div>
    </div>

    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $qrCodeText = "Certificate ID: {$row['certificate_id']}\nName: {$row['name']}";
        $qrCodeOptions = new chillerlan\QRCode\QROptions([
            'outputType' => 'png',
            'eccLevel' => chillerlan\QRCode\QRCode::ECC_L,
        ]);


        $qrCode = new chillerlan\QRCode\QRCode($qrCodeOptions);
        $qrImagePath = 'save/qr_code.png';
        $qrCode->render($qrCodeText, $qrImagePath);

        echo "<div class='text-xl mt-5 space-y-2 font-bold' style='width: 80%; margin-left: auto; margin-right: auto;'>";
        echo "<h2 class='pl-10 py-2' style='color: #00000; background-color: #12EA9C; border-radius: 10px;'>Certified</h2>";
        echo "<div class='flex flex-col md:flex-row'>";
        echo "<div class=' md:w-2/4'>";
        echo "<div class='space-y-2 w-full'>";
        echo "<h4>Certificate ID: {$row['certificate_id']}</h4>";
        echo "<h4>Name: {$row['name']}</h4>";
        echo "<h4>Father's Name: {$row['father_name']}</h4>";
        echo "<h4>Mother's Name: {$row['mother_name']}</h4>";
        echo "</div>";
        echo "</div>";
        echo "<div class=' md:w-2/4'>";
        echo "<div class='space-y-2'>";
        echo "<h4>Course Name: {$row['course_name']}</h4>";
        echo "<h4>Batch Number: {$row['batch_number']}</h4>";
        echo "<h4>Course End Date: {$row['course_end_date']}</h4>";
        echo "<h4>Certificate Date: {$row['certificate_date']}</h4>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<h2 class='text-2xl mt-5 font-bold' style='text-align:center; margin-top:20px;'>Certificate Display:</h2>";
        echo "<div style='position: relative;'>";
        echo "<img style='width: 100%; margin-left: auto; margin-right: auto;' src='https://www.certificate.creativeit.xyz/front/images/certificate/certificate5.jpg'>";
        echo "<div class='iddate'>";
        echo "<p><span class='text-xs md:text-base' style=' text-align: left;'>ID No:</span> <br><span class='text-xs md:text-base' style=' font-weight: bold; text-align: left;'>{$row['certificate_id']}</span> <br><span><span class='text-xs md:text-base' style=' text-align: left;'>Date of Issue:</span> <br><span class='text-xs md:text-base' style=' font-weight: bold; text-align: left;'>{$row['certificate_date']}</span> </p>";
        echo "</div>";
        echo "<div class='present'>";
        echo "<p class='text-sm md:text-lg' style=' text-align: left; margin: 0;'>Presented to<br><span class='text-base md:text-2xl' style=' font-weight: bold; text-align: left;'>{$row['name']}</span></p>";
        echo "</div>";
        echo "<div class='text'>";
        echo "<p class='text-[10px] md:text-[14px]' style=' text-align: left;'>Child of <b>{$row['father_name']}</b> & <b>{$row['mother_name']}</b> has successfully completed the <b>{$row['course_name']}</b> course held on 30 August 2021 to 02 March 2022 at <span style='color: red'>Creative IT Institute.</span></p>";
        echo "</div>";
        echo "<div class='myElement'>";
        echo "<img class='w-1/4 md:w-3/4' src='save/qr_code.png'>";
        echo "</div>";

        echo "<style>";
        echo ".button-container {";
        echo "  text-align: center;";
        echo "  justify-content: center;";
        echo "  margin-bottom: 50px;";
        echo "}";
        echo "a.button-link {";

        echo "  margin: 10px;";
        echo "  padding: 10px 20px;";
        echo "  text-decoration: none;";
        echo "  background-color: #4caf50;";
        echo "  color: #fff;";
        echo "  border: none;";
        echo "  border-radius: 4px;";
        echo "  cursor: pointer;";
        echo "  transition: background-color 0.3s;";
        echo "}";
        echo "a.button-link:hover {";
        echo "  background-color: #45a049;";
        echo "}";
        echo "</style>";

        echo "<div class='button-container'>";
        echo "<a class='button-link' href='generate_pdf.php?certificate_id={$row['certificate_id']}' target='_blank'>Download PDF</a>";
        echo "<a class='button-link' href='generate_jpg.php?certificate_id={$row['certificate_id']}' target='_blank'>Download JPG</a>";
        echo "</div>";

        echo "</div>";
    } else {
        echo "No Matching record found";
    }
    include 'footer.php';
    ?>
</body>

</html>