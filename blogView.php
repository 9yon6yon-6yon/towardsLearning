<?php
include('includes/header.php');
include('includes/navbar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == 1) {
	if (isset($_POST['comment']) and $_POST['comment'] != "") {
		$sql = "SELECT * FROM blogdata ORDER BY blogId DESC";
		$result = mysqli_query($db, $sql);

		while ($row = $result->fetch_array()) {
			$check = "submit" . $row['blogId'];
			if (isset($_POST[$check])) {
				$blogId = $row['blogId'];
				break;
			}
		}

		$comment = dataFilter($_POST['comment']);
		if (isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == 1) {
			$commentUser = $_SESSION['Username'];
			$pic = $_SESSION['picName'];
		} else {
			$commentUser = "Anonymous";
			$pic = "profile0.png";
		}
		if (isset($blogId)) {
			$sql = "INSERT INTO blogfeedback (blogId, comment, commentUser, commentPic)
						VALUES ('$blogId' ,'$comment', '$commentUser', '$pic');";
			$result = mysqli_query($db, $sql);
		}
	} else {
		$sql = "SELECT * FROM blogdata ORDER BY blogId DESC";
		$result = mysqli_query($db, $sql);

		while ($row = $result->fetch_array()) {
			$check = "like" . $row['blogId'];
			if (isset($_POST[$check])) {
				$blogId = $row['blogId'];
				break;
			}
		}
		$likeCheck = "isLiked" . $blogId;
		if (!isset($_SESSION[$likeCheck]) or $_SESSION[$likeCheck] == 0) {
			$id = $_SESSION['id'];
			$sql = "SELECT * FROM likedata WHERE blogId = '$blogId' AND blogUserId = '$id'";
			$result = mysqli_query($db, $sql);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows == 0) {
				$sql = "INSERT INTO likedata (blogId, blogUserId)
							VALUES('$blogId', '$id')";
				$result = mysqli_query($db, $sql);
				$sql = "UPDATE blogdata SET likes = likes + 1 WHERE blogId = '$blogId'";
				$result = mysqli_query($db, $sql);
				$_SESSION[$likeCheck] = 1;
			}
		}
	}
}

function dataFilter($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$sql = "SELECT * FROM blogdata ORDER BY blogId DESC";
$result = mysqli_query($db, $sql);

function formatDate($date)
{
	return date('g:i a', strtotime($date));
}

?>
<section id="main" class="wrapper">
	<div class="inner">
		<div class="container" style="width: 70%">
			<div class="row uniform">
				<div class="9u 12u$(small)">

				</div>
				<div class="3u 12u$(small)">
					<a href="blogWrite.php" class="button special fit"><span class="glyphicon glyphicon-pencil"></span> Write a Blog</a>
				</div>
			</div>
			<br />
			<?php
			while ($row = $result->fetch_array()) :
				$id = $row['blogId'];
				$sql = "SELECT * FROM blogfeedback WHERE blogId = '$id'";
				$result1 = mysqli_query($db, $sql);
				$numComment = mysqli_num_rows($result1);
			?>
				<div class="box">
					<h2><?= $row['blogTitle']; ?></h2>
					<blockquote>
						<?= $row['blogContent']; ?>
						<p>--- <?= $row['blogUser']; ?></p>
						<p><?= $row['blogTime']; ?></p>
					</blockquote>

					<form method="post" action="blogView.php">
						<div class="row">
							<div class="6u 12u$(xsmall)">
								<button class="button special small" name="<?php echo 'like' . $id; ?>">
									<span class="glyphicon glyphicon-thumbs-up"></span> Like</button>
								<span><?= $row['likes'] ?></span>
							</div>
							<div class="6u 12u$(xsmall)">
								<span class="glyphicon glyphicon-pencil"></span> Comments : <?= $numComment ?></button>
							</div>
							<div class="12u$">
								<br>
								<textarea name="comment" id="comment" rows="1" placeholder="Write a Comment!"></textarea>
							</div>
							<div class="12u$">
								<center>
									<br>
									<input type="submit" name="<?php echo 'submit' . $id; ?>" class="button special small" value="Submit" />
								</center>
							</div>
						</div>
					</form>

					<?php
					if ($result1) :
						while ($row1 = $result1->fetch_array()) :
					?>
							<div class="con darker">
								<img src="<?php echo 'images/profileImages/' . $row1['commentPic'] ?>" alt="Avatar"><span><em><?= $row1['commentUser']; ?></em></span>
								<br>
								<?= $row1['comment']; ?>
								<span class="time-right"><?= formatDate($row1['commentTime']); ?></span>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>

			<?php endwhile; ?>

		</div>
		<span class="hr-line"></span>
		<div class="right-sidebar">
			<?php include('includes/right-sidebar.php'); ?>
		</div>
</section>



<?php
include('includes/modal.php');
include('includes/footer.php');
?>