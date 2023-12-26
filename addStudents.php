<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM courses";
$query = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $certificate_id = $_POST['certificate_id'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $course_name = $_POST['course_name'];
    $batch_number = $_POST['batch_number'];
    $course_end_date = $_POST['course_end_date'];
    $certificate_date = $_POST['certificate_date'];
    $email = $_POST['email']; // New field
    $user_password = $_POST['password']; // New field

    $sql_insert = "INSERT INTO students (certificate_id, name, father_name, mother_name, course_name, batch_number, course_end_date, certificate_date, email, password)
        VALUES ('$certificate_id', '$name', '$father_name', '$mother_name', '$course_name', '$batch_number', '$course_end_date', '$certificate_date', '$email', '$user_password')";

    if ($conn->query($sql_insert) === TRUE) {
        echo '<div id="success-alert" style="background-color: green; color: white; margin-top:30px; padding:20px;" class="bg-green-500 text-white text-xl mt-10 p-4 rounded mt-4">
            <h1>Information Added Successfully! Wait a second...</h1>
        </div>';
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
$sqlb = "SELECT * FROM batches";
$queryb = mysqli_query($conn, $sqlb);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students Information</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center h-full">

    <form action="insert.php" method="post" class="bg-white p-8 rounded shadow-md w-auto">
        <h2 class="text-center text-2xl font-semibold mb-4">Add Students Information:</h2>

        <label for="certificate_id">Certificate ID:</label>
        <input type="text" id="certificate_id" name="certificate_id" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="father_name">Father's Name:</label>
        <input type="text" id="father_name" name="father_name" required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="mother_name">Mother's Name:</label>
        <input type="text" id="mother_name" name="mother_name" required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="course_name">Course Name:</label>
        <select id="course_name" name="course_name" required class="w-full px-4 py-2 mb-4 border rounded">
            <?php
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <option value="<?php echo $row['course_name']; ?>">
                    <?php echo $row['course_name']; ?>
                </option>
                <?php
            }
            ?>
        </select>

        <label for="batch_number" class="block text-gray-700 font-bold mb-2">Batch Name:</label>
        <select id="batch_number" name="batch_number" required class="w-full px-4 py-2 mb-4 border rounded">
            <?php
            while ($row = mysqli_fetch_assoc($queryb)) {
                echo '<option value="' . $row['batch_name'] . '">' . $row['batch_name'] . '</option>';
            }
            ?>
        </select>

        <label for="course_end_date">Course End Date:</label>
        <input type="date" id="course_end_date" name="course_end_date" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="certificate_date">Certificate Date:</label>
        <input type="date" id="certificate_date" name="certificate_date" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <input type="submit" value="Add to Database" class="bg-green-500 text-white px-6 py-2 rounded cursor-pointer">

    </form>
</body>

</html>