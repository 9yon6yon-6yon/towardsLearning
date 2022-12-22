<?php
session_start();
include '../config.php';
if (!isset($_SESSION['email'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../admin-login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

	<nav class="navbar navbar-expand-sm navbar-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="javascript:void(0)">Admin Panel</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav me-auto">
				</ul>
				<form class="d-flex">
					<input class="form-control me-2" type="text" placeholder="Search">
					<button class="btn btn-dark" type="button" style="background: #fff3d6 !important; color: black">Search</button>
				</form>
			</div>
		</div>
	</nav>

	<div class="main">
		<div class="sidebar">
			<a class="active" href="../admin.php">Dashboard</a>
			<a href="admin-approval.php">Teacher Approval</a>
			<a href="admin-users.php">Students</a>
			<a href="admin-teacher.php">Teachers</a>
			<a href="admin-question.php">Questions</a>
			<a href="../logout.php">Logout</a>

		</div>

		<div class="content">
			<h2 style="margin-bottom: 50px;">All Students List</h2>

			<table class="table">
				<thead class="table-dark">
					<tr>
						<td>#</td>
						<td>Avatar</td>
						<td>ID</td>
						<td>Name</td>
						<td>Email</td>
						<td>Points</td>
						<td>Rank</td>
						<td>Action</td>
					</tr>
				</thead>

				<?php
				$stu = mysqli_query($db, "SELECT * FROM students") or die(mysqli_error($db));

				$count = 1;
				?>
				<tbody>
					<?php
					while ($s = mysqli_fetch_assoc($stu)) {

					?>
						<tr>
							<td><?php echo $count ?></td>
							<td><img src="../uploads/<?php echo $s['img']; ?>" height="50" width="50" alt="" loading="lazy" /></td>
							<td><?php echo $s['id']; ?></td>
							<td><?php echo $s['Full_Name']; ?></td>
							<td><?php echo $s['Email']; ?></td>
							<td><?php echo $s['points']; ?></td>
							<td><?php echo $s['Rank']; ?></td>
							<td>
								<form action="admin-process.php" method="POST">
									<input type="text" name="st_id" value="<?php echo $s['id']; ?>" style="display: none;">
									<input type="submit" class="btn btn-danger" value="Delete" name="student-delete">
								</form>
							</td>
						</tr>
					<?php
						$count++;
					}
					?>

				</tbody>
			</table>



		</div>
	</div>

</body>

</html>