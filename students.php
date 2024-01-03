<?php
include 'config.php'; 

session_start();

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
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script> -->
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

		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: auto;
		}

		.dashboard-container {

			width: 100%;
		}

		.sidebar {

			background-color: #333;
			padding: 20px;
			height: 100vh;
		}

		.sidebar ul {
			list-style-type: none;
			padding: 0;
		}

		.sidebar li {
			margin-bottom: 10px;
		}

		.sidebar a {
			text-decoration: none;
		}

		.sidebar a:hover {
			color: #ffd700;
		}

		.content {
			flex-grow: 1;
			padding: 20px;
			max-width: 100%;
		}

		.content h2 {
			margin-bottom: 20px;
		}

		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<body class="bg-gray-800 text-white">
	<div class="dashboard-container flex flex-col md:flex-row">
		<div class="sidebar bg-gray-900 p-4 h-full md:h-screen w-full md:w-60">
			<div class="sidebar-start">
				<div class="dropdown">
					<div tabindex="0" role="button"
						class="bg-gray-400 p-4 rounded-lg hover:border-2 hover:border-white lg:hidden">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4 6h16M4 12h8m-8 6h16" />
						</svg>
					</div>
					<ul tabindex="0"
						class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
						<li
							class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/index.php" class="menu-item"
								style="display: block; width: 100%; height: 100%;">Front Home</a>
						</li>

						<li
							class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/admin.php?page=dashboard" class="menu-item"
								style="display: block; width: 100%; height: 100%;">Profile</a>
						</li>
						<li
							class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/admin.php?page=add_option" class="menu-item"
								style="display: block; width: 100%; height: 100%;">All Courses</a>
						</li>
						<li
							class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/admin.php?page=add_batch" class="menu-item"
								style="display: block; width: 100%; height: 100%;">All Batches</a>
						</li>

						<div class="dropdown dropdown-right">
							<li tabindex="0" role=""
								class="menu-item mb-2 bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white"
								style="display: block; width: 100%; height: 100%;">
								Manage Students
							</li>
							<ul tabindex="0"
								class="dropdown-content z-[1] menu shadow bg-base-200 p-4 rounded-box w-52">
								<li
									class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
									<a href="/cit/admin.php?page=addStudents" class="menu-item"
										style="display: block; width: 100%; height: 100%;">Add Students</a>
								</li>
								<li
									class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
									<a href="/cit/admin.php?page=pagination" class="menu-item"
										style="display: block; width: 100%; height: 100%;">View Students</a>
								</li>
							</ul>
						</div>

						<li
							class="bg-zinc-300 mt-2 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/admin.php?page=users" class="menu-item"
								style="display: block; width: 100%; height: 100%;">Admin's</a>
						</li>
						<li
                            class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=editable" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Editable Pages</a>
                        </li>
						<li
							class="bg-zinc-300 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
							<a href="/cit/admin.php?logout=true" class="menu-item"
								style="display: block; width: 100%; height: 100%;">Log Out</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="navbar-center hidden lg:flex">
				<ul class="menu menu-horizontal px-1">
					<li
						class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="index.php" class="menu-item" style="display: block; width: 100%; height: 100%;">Front
							Home</a>
					</li>

					<li
						class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="admin.php?page=dashboard" class="menu-item"
							style="display: block; width: 100%; height: 100%;">Profile</a>
					</li>
					<li
						class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="admin.php?page=add_option" class="menu-item"
							style="display: block; width: 100%; height: 100%;">All Courses</a>
					</li>
					<li
						class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="admin.php?page=add_batch" class="menu-item"
							style="display: block; width: 100%; height: 100%;">All Batches</a>
					</li>

					<div class="dropdown dropdown-right w-full">
						<li tabindex="0" role=""
							class="menu-item bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white"
							style="display:block; width: 100%; height: 100%;">
							Manage Students
						</li>
						<ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-200 p-4 rounded-box w-52">
							<li
								class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
								<a href="admin.php?page=addStudents" class="menu-item"
									style="display: block; width: 100%; height: 100%;">Add Students</a>
							</li>
							<li
								class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
								<a href="students.php" class="menu-item"
									style="display: block; width: 100%; height: 100%;">View Students</a>
							</li>
						</ul>
					</div>

					<li
						class="bg-zinc-300 w-full mt-2 text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="/cit/admin.php?page=users" class="menu-item"
							style="display: block; width: 100%; height: 100%;">Admin's</a>
					</li>
					<li
                            class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
                            <a href="admin.php?page=editable" class="menu-item"
                                style="display: block; width: 100%; height: 100%;">Editable Pages</a>
                        </li>
					<li
						class="bg-zinc-300 w-full text-black px-4 py-2 rounded-lg hover:bg-zinc-600 hover:cursor-pointer hover:text-white">
						<a href="/cit/admin.php?logout=true" class="menu-item"
							style="display: block; width: 100%; height: 100%;">Log Out</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="content">
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
								echo "<td class='py-2 px-1 text-sm' style='width: 5%'><a href='/cit/edit.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Edit</a></td>";
								echo "<td class='py-2 px-1 text-sm' style='width: 5%'><a href='/cit/delete.php?id={$row['id']}' class='text-white p-4 rounded-lg hover:bg-slate-700'>Delete</a></td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>

				<ul class="flex gap-5 mt-30">
					<?php for ($i = 1; $i <= $pagi; $i++): ?>
						<?php
						$class = $current_page == $i ? 'bg-green-600 cursor-pointer px-2 py-2 active hover:bg-green-800' : 'page-item p-2 cursor-pointer hover:bg-green-800 hover:p-2';
						?>
						<li class="<?php echo $class; ?>">
							<a class="page-link" href="<?= $class === 'active' ? 'javascript:void(0)' : "?start={$i}" ?>">
								<?php echo $i; ?>
							</a>
						</li>
					<?php endfor; ?>
				</ul>

			</div>
		</div>
	</div>


</body>

</html>