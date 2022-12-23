<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="inner">
	<div class="container" style="width: 70%">
		<div class="row uniform">
			<div class="9u 12u$(small)">

			</div>
			<div class="3u 12u$(small)">
				<a href="blogView.php" class="button special fit">View Blogs</a>
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
						<input type="submit" name="submit" class="button special" value="SUBMIT" />
					</center>
				</div>
			</div>
		</div>
	</div>

	<script>
		CKEDITOR.replace('blogContent');
	</script>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<?php include('includes/right-sidebar.php'); ?>
</div>

<?php
include('includes/modal.php');
include('includes/footer.php');
?>