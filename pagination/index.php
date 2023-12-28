<?php
$conn = mysqli_connect('localhost', 'root', '', 'creativeit');


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


$per_page = 5;
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
// Modify the main query to include the WHERE clause
$sql = "SELECT * FROM students $whereClause ORDER BY id DESC LIMIT $start, $per_page";
$res = mysqli_query($conn, $sql);

$record = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students $whereClause"));
$pagi = ceil($record / $per_page);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pagination Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		.mt-100 {
			margin-top: 50px;
		}

		.mt-30 {
			margin-top: 30px;
		}

		.mb-30 {
			margin-bottom: 30px;
		}
	</style>
</head>

<body class="bg-gray-800 text-white">
	<div class="container w-11/12 mx-auto p-8">
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
		<form method="post" class="mt-8 mb-4 bg-gray-500 text-center">
			<h1 class="text-2xl mb-4">Filter students:</h1>
			<div class="flex flex-col md:flex-row justify-center space-x-4">
				<div>
					<label for="filter_certificate_id" class="block text-white">by Certificate ID:</label>
					<input type="text" id="filter_certificate_id" name="filter_certificate_id"
						value="<?= $filterCertificateId ?>" class="px-4 py-2 border rounded bg-gray-700 text-white">
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
		<table class="mt-4 w-ful border border-green-500">
			<thead>
				<tr class="bg-green-500 text-white">
					<th class="py-2 px-1">Certificate ID</th>
					<th class="py-2 px-1">Name</th>
					<th class="py-2 px-1">Father's Name</th>
					<th class="py-2 px-1">Mother's Name</th>
					<th class="py-2 px-1">Course Name</th>
					<th class="py-2 px-1">Batch Number</th>
					<th class="py-2 px-1">Course End Date</th>
					<th class="py-2 px-1">Certificate Date</th>
					<th class="py-2 px-1">Edit</th>
					<th class="py-2 px-1">Delete</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$rowColor = 0;
				while ($row = $res->fetch_assoc()) {
					$rowColorClass = ($rowColor++ % 2 == 0) ? 'bg-cyan-600' : 'bg-pink-600';
					echo "<tr class='text-white $rowColorClass'>";
					echo "<td class='py-2 px-1'>" . $row['certificate_id'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['name'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['father_name'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['mother_name'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['course_name'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['batch_number'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['course_end_date'] . "</td>";
					echo "<td class='py-2 px-1'>" . $row['certificate_date'] . "</td>";
					echo "<td class='py-2 px-1'><a href='edit.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Edit</a></td>";
					echo "<td class='py-2 px-1'><a href='delete.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Delete</a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<ul class="pagination mt-30">
			<?php
			for ($i = 1; $i <= $pagi; $i++) {
				$class = '';
				if ($current_page == $i) {
					?>
					<li class="page-item active"><a class="page-link" href="javascript:void(0)">
							<?php echo $i ?>
						</a></li>
					<?php
				} else {
					?>
					<li class="page-item"><a class="page-link" href="?start=<?php echo $i ?>">
							<?php echo $i ?>
						</a></li>
					<?php
				}
				?>

			<?php } ?>
		</ul>
	</div>

	<div class="text-center pb-10">
		<a href="/cit/admin.php" class="btn btn-primary">
			Go Back
		</a>
	</div>




</body>

</html>