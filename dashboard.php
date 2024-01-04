<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

$query = "SELECT * FROM information ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
} else {
    echo "Error: " . mysqli_error($conn);
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://kit.fontawesome.com/72d0103d4a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #585555;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .content {
            padding: 20px;
            width: 100%;
            color: white;
        }

        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        /* .statistics-box {
            background-color: #3498db;
            color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .statistics-box p {
            margin: 0;
            font-size: 18px;
        } */

        h3 {
            margin-top: 20px;
            text-align: center;
            font-size: 38px;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            overflow-x: auto;
        }

        table,
        th,
        td {
            border: 2px solid #ddd;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .state-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .logo-container {
            position: relative;
        }

        .edit-icon {
            display: none;
            position: absolute;
            top: 50%;
            left: 57%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            color: white;
            background-color: #007bff;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 18px;
        }

        .logo-container:hover .edit-icon {
            display: block;
        }

        /* .nav_form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        } */

        nav input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        nav input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        nav input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Profile</title>
</head>

<body class="bg-gray-800 text-white">

    <div class="flex flex-col md:flex-row justify-between items-center bg-amber-600 px-10 py-6 md:py-0 rounded-lg">
        <nav class="flex flex-col md:flex-row justify-center logo-container relative">
            <img class="bg-white w-16 md:w-24 rounded-full" src="uploads/abcdef.png?<?php echo time(); ?>" alt="Logo">
            <i class="fa-solid fa-pen-to-square edit-icon hover:cursor-pointer" onclick="my_modal_6.showModal()"></i>
            <dialog id="my_modal_6" class="modal modal-bottom sm:modal-middle">
                <form class="nav_form bg-white w-4/5 md:w-2/5 mx-auto" id="uploadForm" enctype="multipart/form-data">
                    <h2>Upload Logo</h2>

                    <label for="logo">Choose a logo:</label>
                    <input class="text-black" type="file" id="logo" name="logo" accept="image/*" required>

                    <input class="text-black hover:bg-gray-300 hover:cursor-pointer" type="button" value="Upload"
                        onclick="uploadLogo()">
                    <div class="text-center"><a href="admin.php?page=dashboard"><i
                                class="fa-solid text-black p-2 text-2xl fa-xmark hover:text-white hover:bg-red-500 hover:p-2"></i></a>
                    </div>
                </form>

            </dialog>
        </nav>


        <h1 class=" text-lg md:text-2xl py-2 px-1">
            <?php echo "<p>" . $name . "</p>"; ?>
        </h1>

        <div>
            <a  class="bg-lime-700 text-lg md:text-2xl py-2 px-1 rounded-md hover:bg-green-600" href="admin.php?page=information">Edit Information</a>
        </div>

        <!-- <div class="text-2xl text-center text-red relative hover:cursor-pointer hover:text-white">
            <?php echo isset($_POST['newTitle']) ? htmlspecialchars($_POST['newTitle']) : 'Creative IT'; ?>
            <i class="fa-solid fa-pen-to-square hover:cursor-pointer" onclick="my_modal_5.showModal()"></i>
            <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
                <form class="bg-blue-500 flex flex-col" method="post" action="">
                    <label for="newTitle">Enter new website title:</label>
                    <input class="text-black" type="text" id="newTitle" name="newTitle" required>
                    <button class="mt-4 text-lg w-32 mx-auto bg-red-600 hover:bg-green-600" type="submit">Click
                        here</button>
                </form>
                <form class="bg-red-600" method="dialog">
                    <button><i class="fa-solid fa-xmark"></i></button>
                </form>
            </dialog>
        </div> -->


    </div>


    <div class="content">
        <?php
        $totalRecordsQuery = "SELECT COUNT(*) as total_records FROM students";
        $totalRecordsResult = $conn->query($totalRecordsQuery);
        $totalRecords = $totalRecordsResult->fetch_assoc()['total_records'];

        $totalCertificatesQuery = "SELECT COUNT(DISTINCT certificate_id) as total_certificates FROM students";
        $totalCertificatesResult = $conn->query($totalCertificatesQuery);
        $totalCertificates = $totalCertificatesResult->fetch_assoc()['total_certificates'];

        $totalCoursesQuery = "SELECT COUNT(*) as total_course FROM courses";
        $totalCoursesResult = $conn->query($totalCoursesQuery);
        $totalCourses = $totalCoursesResult->fetch_assoc()['total_course'];

        $totalBatchesQuery = "SELECT COUNT(*) as total_batch FROM batches";
        $totalBatchesResult = $conn->query($totalBatchesQuery);
        $totalBatches = $totalBatchesResult->fetch_assoc()['total_batch'];
        ?>

        <div class="md:w-4/5 mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 my-10">
            <div class="bg-blue-600 text-center font-bold text-2xl rounded-lg flex flex-col justify-center py-4">
                <p>Total Number of Records</p>
                <h3>
                    <?php echo $totalRecords; ?>
                </h3>
            </div>

            <div class="bg-rose-600 text-center font-bold text-2xl rounded-lg flex flex-col justify-center py-4">
                <p>Total Number of Certificates</p>
                <h3>
                    <?php echo $totalCertificates; ?>
                </h3>
            </div>

            <div class="bg-indigo-600 text-center font-bold text-2xl rounded-lg flex flex-col justify-center py-4">
                <p>Total Number of Courses</p>
                <h3>
                    <?php echo $totalCourses; ?>
                </h3>
            </div>

            <div class="bg-violet-600 text-center font-bold text-2xl rounded-lg flex flex-col justify-center py-4">
                <p>Total Number of Batches</p>
                <h3>
                    <?php echo $totalBatches; ?>
                </h3>
            </div>
        </div>

        <div class="bg-white">
            <h1 class="text-white py-2 bg-violet-600 text-3xl text-center">Statistics Bar:</h1>
            <div>
            <canvas id="statisticsChart" width="100" height="40" ></canvas>
            </div>
        </div>
    </div>


    <!-- <form class="text-black" id="searchForm" method="post" action="index.php">
        <label for="searchType">Select Search Type:</label>
        <select id="searchType" name="searchType" onchange="toggleSubmitButton()"
            class="bg-white p-2 border rounded">
            <option value="selected" disabled selected>Select Search Type</option>
            <option value="search">Search</option>
            <option value="search_sec">Search (Secondary)</option>
        </select>
        <input type="submit" value="OK" id="submitButton" disabled
            class="bg-green-500 text-white p-2 ml-2 rounded cursor-pointer">
    </form> -->

    <script>
        function uploadLogo() {
            var formData = new FormData(document.getElementById('uploadForm'));

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Logo uploaded successfully!');
                        location.reload();
                    } else {
                        alert('Error uploading logo. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }

        function closeModal() {
            document.getElementById('my_modal_6').open = false;
        }

        function toggleSubmitButton() {
            var selectedValue = document.getElementById("searchType").value;
            var submitButton = document.getElementById("submitButton");

            if (selectedValue !== "selected") {
                submitButton.removeAttribute("disabled");
            } else {
                submitButton.setAttribute("disabled", "disabled");
            }
        }


        var ctx = document.getElementById('statisticsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Records', 'Total Certificates', 'Total Course', 'Total Batch'],
                datasets: [{
                    label: 'Statistics',
                    data: [<?php echo $totalRecords; ?>, <?php echo $totalCertificates; ?>, <?php echo $totalCourses; ?>, <?php echo $totalBatches; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderColor: [
                        'rgba(240, 128, 128)',
                        'rgba(240, 128, 128)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>
</body>

</html>