<?php
include('includes/header.php');
include('includes/navbar.php');
$query = mysqli_query($db, "SELECT * FROM students where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);
?>
<form method="POST" action="process.php">
	<div class="main-area">
		<div class="question" id="response" style="width: 70%">
			<div class="row uniform">
				<div class="3u 12u$(small)">
					<a href="blogView.php" class="button special fit"><span class="glyphicon glyphicon-pencil"></span> <button type="button" class="btn btn-outline-primary" style="margin-right: 20px;border-radius: 30px !important;">View Blog</button></a>
				</div>
			</div>
			<br />
			<div class="box">
				<div class="row uniform">
					<div class="12u$">
						<input type="text" name="blogTitle" id="blogTitle" value="" placeholder="Blog Title" required />
					</div>
					<div class="12u$">
						<textarea name="blogContent" id="blogContent" rows="12" placeholder="Blog Content"></textarea>
					</div>
					<br>
					<div class="12u$">
						<center>
							<button type="submit" class="btn btn-outline-primary" name="blogSubmit" style="margin-right: 6px;border-radius: 12px !important;">Submit</button>
						</center>
					</div>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<?php include('includes/right-sidebar.php'); ?>
		</div>
</form>
<script>
	CKEDITOR.replace('blogContent');
</script>

</div>
<span class="hr-line"></span>
<?php
include('includes/modal.php');
include('includes/footer.php');
?>