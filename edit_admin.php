<?php
include 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$studentId = $_GET['id'];
$fetchStudentQuery = "SELECT * FROM users WHERE id = $studentId";
$fetchStudentResult = $conn->query($fetchStudentQuery);
$studentDetails = $fetchStudentResult->fetch_assoc();

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
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <form action="update_admin.php" method="post" class="w-1/2 mx-auto mt-8 bg-white p-8 rounded shadow-lg">
        <input type="hidden" name="id" value="<?php echo $studentDetails['id']; ?>">

        <h2 class="text-2xl font-bold mb-4 text-center">Edit Admin Information</h2>

        <label for="name" class="block mb-2 font-bold">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $studentDetails['name']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="email" class="block mb-2 font-bold">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $studentDetails['email']; ?>"
            required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="password" class="block mb-2 font-bold">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $studentDetails['password']; ?>"
            required class="w-full px-4 py-2 mb-4 border rounded">

        <input type="submit" value="Update"
            class="w-full px-4 py-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
    </form>
</body>

</html>
