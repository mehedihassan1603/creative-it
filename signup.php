<?php
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "creativeit";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup_submit'])) {
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $course_name = $_POST['course_name'];
    $batch_number = $_POST['batch_number'];
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Check if email already exists
    $check_email_sql = "SELECT * FROM students WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_sql);

    if ($check_email_result->num_rows > 0) {
        echo "Email already exists. Please choose a different email.";
        $conn->close();
        exit();
    }

    // Insert into students table
    $sql = "INSERT INTO students (name, father_name, mother_name, course_name, batch_number, email, password)
        VALUES ('$name', '$father_name', '$mother_name', '$course_name', '$batch_number', '$email', '$user_password')";

    // Insert into users table
    $sql_user = "INSERT INTO users (email, password)
        VALUES ('$email', '$user_password')";

    if ($conn->query($sql) === TRUE && $conn->query($sql_user) === TRUE) {
        header("refresh:2;url=index.php");
        echo '<div id="success-alert" style="background-color: blue; color: white; margin-top:30px; padding:20px;" class="bg-blue-400 text-white text-xl mt-10 p-4 rounded mt-4">
            <h1>Information Added Successfully! Wait a second...</h1>
        </div>';
        
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}

// Fetch courses
$sql = "SELECT * FROM courses";
$query = mysqli_query($conn, $sql);
$sqlb = "SELECT * FROM batches";
$queryb = mysqli_query($conn, $sqlb);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-8 mt-8">
        <h2 class="text-2xl font-bold text-center">Sign Up</h2>
        <form method="post" action="SignUp.php" class="mt-4">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="father_name" class="block text-gray-700 font-bold mb-2">Father's Name:</label>
                <input type="text" id="father_name" name="father_name" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="mother_name" class="block text-gray-700 font-bold mb-2">Mother's Name:</label>
                <input type="text" id="mother_name" name="mother_name" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:</label>
                <select id="course_name" name="course_name" required class="w-full px-4 py-2 mb-4 border rounded">
                    <?php
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="batch_number" class="block text-gray-700 font-bold mb-2">Batch Name:</label>
                <select id="batch_number" name="batch_number" required class="w-full px-4 py-2 mb-4 border rounded">
                    <?php
                    while ($row = mysqli_fetch_assoc($queryb)) {
                        echo '<option value="' . $row['batch_name'] . '">' . $row['batch_name'] . '</option>';
                    }
                    ?>
                </select>

            </div>
            <button type="submit" name="signup_submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Sign Up
            </button>
        </form>
        <div class="mt-4 text-center">
            <p>Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
        </div>
    </div>

</body>

</html>