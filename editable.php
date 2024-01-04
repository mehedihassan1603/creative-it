<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
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
    <title>Users Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-800 text-white">
    <div class="grid grid-cols-1 md:grid-cols-2 justify-center w-10/12 mx-auto text-center text-lg gap-10 mt-10">
        <a href="admin.php?page=edit_about_us" class="bg-teal-500 p-3 px-10 py-12 rounded-lg hover:bg-teal-600">Edit About Page</a>
        <a href="admin.php?page=edit_reviews" class="bg-teal-500 p-3 px-10 py-12 rounded-lg hover:bg-teal-600">Edit Reviews</a>
        <a href="admin.php?page=edit_contact" class="bg-teal-500 p-3 px-10 py-12 rounded-lg hover:bg-teal-600">Edit contact</a>
        <a href="admin.php?page=edit_privacy" class="bg-teal-500 p-3 px-10 py-12 rounded-lg hover:bg-teal-600">Edit privacy</a>
        <a href="admin.php?page=edit_terms" class="bg-teal-500 p-3 px-10 py-12 rounded-lg hover:bg-teal-600">Edit terms</a>
    </div>
</body>

</html>

<?php
$conn->close();
?>
