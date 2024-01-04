<?php
include 'config.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION['email'])) {
	header("Location: login.php");
	exit();
}
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$filterCertificateId = isset($_POST['filter_certificate_id']) ? mysqli_real_escape_string($conn, $_POST['filter_certificate_id']) : '';
$filterCourseName = isset($_POST['filter_course_name']) ? mysqli_real_escape_string($conn, $_POST['filter_course_name']) : '';
$filterBatchName = isset($_POST['filter_batch_name']) ? mysqli_real_escape_string($conn, $_POST['filter_batch_name']) : '';
$filterCertificate = isset($_POST['filter_certificate']) ? mysqli_real_escape_string($conn, $_POST['filter_certificate']) : '';
$whereClause = "WHERE 1";
if ($filterCertificateId !== '') {
	$whereClause .= " AND certificate_id = '$filterCertificateId'";
}
if ($filterCourseName !== '') {
	$whereClause .= " AND course_name = '$filterCourseName'";
}
if ($filterBatchName !== '') {
	$whereClause .= " AND batch_number = '$filterBatchName'";
}
if ($filterCertificate === 'with_certificate') {
	$whereClause .= " AND certificate_id IS NOT NULL AND certificate_id <> ''";
} elseif ($filterCertificate === 'without_certificate') {
	$whereClause .= " AND (certificate_id IS NULL OR certificate_id = '')";
}
$per_page = 10;
$start = 0;
$current_page = 1;
if (isset($_GET['start'])) {
	$start = $_GET['start'];
	if ($start <= 0) {
		$start = 0;
		$current_page = 1;
	} else {
		$current_page = $start;
		$start--;
		$start = $start * $per_page;
	}
}
$sql = "SELECT * FROM students $whereClause ORDER BY id DESC LIMIT $start, $per_page";
$res = mysqli_query($conn, $sql);

$record = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students $whereClause"));
$pagi = ceil($record / $per_page);

if (isset($_GET['logout'])) {
	session_destroy();
	header("Location: login.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Students</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		
	</style>
</head>

<body class="bg-gray-800 text-white w-full">
	<div class="">
			<div class="w-full md:w-11/12 mx-auto">
				<?php
				$totalRecordsQuery = "SELECT COUNT(*) as total_records FROM students";
				$totalRecordsResult = $conn->query($totalRecordsQuery);
				$totalRecords = $totalRecordsResult->fetch_assoc()['total_records'];

				$totalCertificatesQuery = "SELECT COUNT(DISTINCT certificate_id) as total_certificates FROM students";
				$totalCertificatesResult = $conn->query($totalCertificatesQuery);
				$totalCertificates = $totalCertificatesResult->fetch_assoc()['total_certificates'];
				?>
				<h3 class="text-3xl text-center mt-4">Students Information</h3>

				<!-- Filter Form -->
				<form method="post" class="mt-8 mb-4 bg-gray-500 text-center w-11/12 mx-auto">
					<h1 class="text-2xl mb-4">Filter students:</h1>
					<div class="flex flex-col md:flex-row justify-center space-x-4">
						<div>
							<label for="filter_certificate_id" class="block text-white">by Certificate ID:</label>
							<input type="text" id="filter_certificate_id" name="filter_certificate_id"
								value="<?= $filterCertificateId ?>"
								class="px-4 py-2 border rounded bg-gray-700 text-white">
						</div>

						<div>
							<label for="filter_course_name" class="block text-white">by Course Name:</label>
							<select id="filter_course_name" name="filter_course_name"
								class="px-4 py-2 border rounded bg-gray-700 text-white">
								<option value="" <?= $filterCourseName === '' ? 'selected' : '' ?>>All</option>

								<?php
								$courseQuery = "SELECT DISTINCT course_name FROM students";
								$courseResult = $conn->query($courseQuery);

								while ($row = $courseResult->fetch_assoc()) {
									$selected = ($filterCourseName === $row['course_name']) ? 'selected' : '';
									echo "<option value='{$row['course_name']}' $selected>{$row['course_name']}</option>";
								}
								?>
							</select>
						</div>

						<div>
							<label for="filter_batch_name" class="block text-white">by batch Name:</label>
							<select id="filter_batch_name" name="filter_batch_name"
								class="px-4 py-2 border rounded bg-gray-700 text-white">
								<option value="" <?= $filterBatchName === '' ? 'selected' : '' ?>>All</option>

								<?php
								$batchQuery = "SELECT DISTINCT batch_number FROM students";
								$batchResult = $conn->query($batchQuery);

								while ($row = $batchResult->fetch_assoc()) {
									$selected = ($filterBatchName === $row['batch_number']) ? 'selected' : '';
									echo "<option value='{$row['batch_number']}' $selected>{$row['batch_number']}</option>";
								}
								?>
							</select>
						</div>

						<div>
							<label for="filter_certificate" class="block text-white">by Certificate:</label>
							<select id="filter_certificate" name="filter_certificate"
								class="px-4 py-2 border rounded bg-gray-700 text-white">
								<option value="" <?= $filterCertificate === '' ? 'selected' : '' ?>>All</option>
								<option value="with_certificate" <?= $filterCertificate === 'with_certificate' ? 'selected' : '' ?>>With Certificate</option>
								<option value="without_certificate" <?= $filterCertificate === 'without_certificate' ? 'selected' : '' ?>>Without Certificate</option>
							</select>
						</div>

						<div>
							<input type="submit" value="Apply Filters"
								class="px-4 py-2 mt-6 bg-green-500 text-white rounded cursor-pointer">
						</div>
					</div>
				</form>


				<!-- Display Filtered Students -->
				<div class="overflow-x-auto w-11/12 mx-auto">
					<table class="mt-4 w-full border border-green-500">
						<thead>
							<tr class="bg-green-500 text-white">
								<th class="py-2 px-3 text-sm">Certificate ID</th>
								<th class="py-2 px-3 text-sm">Name</th>
								<th class="py-2 px-3 text-sm">Father's Name</th>
								<th class="py-2 px-3 text-sm">Mother's Name</th>
								<th class="py-2 px-3 text-sm">Address</th>
								<th class="py-2 px-3 text-sm">Phone</th>
								<th class="py-2 px-3 text-sm">Email</th>
								<th class="py-2 px-3 text-sm">Password</th>
								<th class="py-2 px-3 text-sm">Course Name</th>
								<th class="py-2 px-3 text-sm">Batch Number</th>
								<th class="py-2 px-3 text-sm">Course End Date</th>
								<th class="py-2 px-3 text-sm">Certificate Date</th>
								<th class="py-2 px-3 text-sm">Edit</th>
								<th class="py-2 px-3 text-sm">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$rowColor = 0;
							while ($row = $res->fetch_assoc()) {
								$rowColorClass = ($rowColor++ % 2 == 0) ? 'bg-cyan-700' : 'bg-slate-600';
								echo "<tr class='text-white $rowColorClass'>";
								echo "<td class='py-2 px-1 text-sm' style='width: 10%'>" . $row['certificate_id'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['name'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['father_name'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['mother_name'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['address'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['phone'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['email'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 15%'>" . $row['password'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 10%'>" . $row['course_name'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 10%'>" . $row['batch_number'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 10%'>" . $row['course_end_date'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 10%'>" . $row['certificate_date'] . "</td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 5%'><a href='edit.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Edit</a></td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 5%'><a href='delete.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Delete</a></td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>

				<!-- Update pagination links -->
				<ul class="flex justify-center gap-5 mt-5">
					<?php for ($i = 1; $i <= $pagi; $i++): ?>
						<?php
						$class = $current_page == $i ? 'bg-green-600 cursor-pointer px-2 py-2 active hover:bg-green-800' : 'page-item p-2 cursor-pointer hover:bg-green-800 hover:p-2';
						?>
						<li class="<?php echo $class; ?>">
							<a class=""
								href="<?= $class === 'active' ? 'javascript:void(0)' : "?page={$page}&start={$i}" ?>">
								<?php echo $i; ?>
							</a>
						</li>
					<?php endfor; ?>
				</ul>


			</div>

	</div>


</body>

</html>