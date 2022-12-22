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
			<h2 style="margin-bottom: 50px;">All Uploaded Questions</h2>

			<table class="table table-hover">
				<thead class="table-dark">
					<tr class="align-middle">
						<td>#</td>
						<td>ID</td>
						<td>Question</td>
						<td>Subject</td>
						<td>Point</td>
						<td>username</td>
						<td>Attachments</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>

				<?php
				$stu = mysqli_query($db, "SELECT q_id, question_detail, question_img, ques_points, username, Subject_Name, created_at, Status  FROM questions q
       JOIN students s ON q.student_id=s.id
       JOIN subjects sub ON q.subject_code=sub.s_code") or die(mysqli_error($db));

				$count = 1;
				?>
				<tbody>
					<?php
					while ($s = mysqli_fetch_assoc($stu)) {

					?>
						<tr class="align-middle">
							<td><?php echo $count ?></td>
							<td><?php echo $s['q_id']; ?></td>
							<td><?php if (strlen($s['question_detail']) > 150) {
									echo substr($s['question_detail'], 0, 100);
								} else {
									echo $s['question_detail'];
								}  ?></td>
							<td><?php echo $s['Subject_Name']; ?></td>
							<td><?php echo $s['ques_points']; ?></td>
							<td><?php echo $s['username']; ?></td>
							<td><img src="../uploads/<?php echo $s['question_img']; ?>" height="70" width="70" alt="" loading="lazy" /></td>
							<td><?php echo $s['Status']; ?></td>
							<td class="buttons align-middle">
								<form action="admin-process.php" method="POST">
									<input type="text" name="ques_id" value="<?php echo $s['q_id']; ?>" style="display: none;">
									<button type="submit" class="btn btn-primary" formaction="view/quesnview.php?ID=<?php echo $s['q_id']; ?>" name="qsn-view">View</button>
									<input type="submit" class="btn btn-danger" value="Delete" name="ques-delete">
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




	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>






</body>

</html>