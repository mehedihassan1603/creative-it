<?php
include 'config.php';

$sqlLastCertificateId = "SELECT MAX(certificate_id) AS last_certificate_id FROM students";
$resultLastCertificateId = mysqli_query($conn, $sqlLastCertificateId);
$rowLastCertificateId = mysqli_fetch_assoc($resultLastCertificateId);
$lastCertificateId = $rowLastCertificateId['last_certificate_id'];

$lastCertificateNumber = (int) substr($lastCertificateId, 4);
$newCertificateNumber = $lastCertificateNumber + 1;

$newCertificateId = 'ECC_' . str_pad($newCertificateNumber, 2, '0', STR_PAD_LEFT);

$studentId = $_GET['id'];

$fetchStudentQuery = "SELECT * FROM students WHERE id = $studentId";
$fetchStudentResult = $conn->query($fetchStudentQuery);
$studentDetails = $fetchStudentResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <form action="update.php" method="post" class="w-1/2 mx-auto mt-8 bg-white p-8 rounded shadow-lg">
        <input type="hidden" name="id" value="<?php echo $studentDetails['id']; ?>">

        <h2 class="text-2xl font-bold mb-4 text-center">Edit Student</h2>

        <label for="certificate_id" class="block mb-2 font-bold">Certificate ID:</label>
        <input type="text" id="certificate_id" name="certificate_id"
            value="<?php echo is_null($studentDetails['certificate_id']) ? $newCertificateId : $studentDetails['certificate_id']; ?>"
            required readonly class="w-full px-4 py-2 mb-4 border rounded">

        <label for="name" class="block mb-2 font-bold">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $studentDetails['name']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="father_name" class="block mb-2 font-bold">Father's Name:</label>
        <input type="text" id="father_name" name="father_name" value="<?php echo $studentDetails['father_name']; ?>"
            required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="mother_name" class="block mb-2 font-bold">Mother's Name:</label>
        <input type="text" id="mother_name" name="mother_name" value="<?php echo $studentDetails['mother_name']; ?>"
            required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="course_name" class="block mb-2 font-bold">Course Name:</label>
        <select id="course_name" name="course_name" required class="w-full px-4 py-2 mb-4 border rounded">
            <?php
            $courseQuery = "SELECT DISTINCT course_name FROM students";
            $courseResult = $conn->query($courseQuery);

            while ($row = $courseResult->fetch_assoc()) {
                $selected = ($row['course_name'] == $studentDetails['course_name']) ? 'selected' : '';
                echo "<option value='{$row['course_name']}' $selected>{$row['course_name']}</option>";
            }
            ?>
        </select>

        <label for="email" class="block mb-2 font-bold">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $studentDetails['email']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="password" class="block mb-2 font-bold">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $studentDetails['password']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="batch_number" class="block mb-2 font-bold">Batch Number:</label>
        <input type="text" id="batch_number" name="batch_number" value="<?php echo $studentDetails['batch_number']; ?>"
            required class="w-full px-4 py-2 mb-4 border rounded">

        <label for="course_end_date" class="block mb-2 font-bold">Course End Date:</label>
        <input type="date" id="course_end_date" name="course_end_date"
            value="<?php echo $studentDetails['course_end_date']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <label for="certificate_date" class="block mb-2 font-bold">Certificate Date:</label>
        <input type="date" id="certificate_date" name="certificate_date"
            value="<?php echo $studentDetails['certificate_date']; ?>" required
            class="w-full px-4 py-2 mb-4 border rounded">

        <input type="submit" value="Update"
            class="w-full px-4 py-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
    </form>
</body>

</html>