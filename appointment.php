<?php 
  include ('includes/header.php');
  include ('includes/navbar.php');


  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
?>

	<div class="contains">
		<div class="appointment-section">
		<div class="appointment-title">
			<h3>Want Some Professional Instructions & Advising?</h3>
			<h4>Hire Our Instructors Now!</h4>
		</div>

		<div class="teachers-info">
			<div class="teacher-card">
				<div class="row row-cols-1 row-cols-md-4 g-5">
<?php
 	$sql = "SELECT * FROM teacher";
  	$resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($db));
  	while( $t = mysqli_fetch_assoc($resultset) ) {
  	?>

					  <div class="col">
					    <div class="card">
					      <div class="card-photo">
					      	<img src="./uploads/<?php echo $t['profile_pic']; ?>" class="card-img-top" alt="image" >
					      </div>
					      <div class="card-body d-flex flex-column align-items-center">
					        <h5 class="card-title" style="margin-bottom: 20px;">Name: <?php echo $t['Name']; ?></h5>
					        <div class="card-text text-center" style="margin-bottom: 10px;"><i class="fas fa-user-graduate" style="margin-right: 10px;"></i>Education: <br> <?php echo $t['Education']; ?></div>
					        <div class="card-text text-center" style="margin-bottom: 10px;"><i class="fas fa-globe-asia" style="margin-right: 10px;"></i>Address:<br> <?php echo $t['address']; ?></div>
					        <div class="card-text text-center" style="margin-bottom: 10px;"><i class="fas fa-book" style="margin-right: 10px;"></i>Speciality:<br> <?php echo $t['Subject']; ?></div>
					        <div class="d-flex card-btn"><div><form method="POST"><button type="submit" class="btn btn-primary" formaction="resume.php?ID=<?php echo $t['id']; ?>" name="res_view">view resume</button></form></div>
					        <div class="hire" >
					       <form method="POST">
					      		<input type="text" name="t_id" hidden value="<?php echo $t['id']; ?>">
					      		<input type="text" name="s_id" hidden value="<?php echo $row['id']; ?>">
					      		<button class="btn btn-success" name="appoint" formaction="set-time.php?ID=<?php echo $t['id']; ?>&Name=<?php echo $t['Name']; ?>" >Hire!</button>
					      	</form></div></div>
					      </div>
					      	
					    </div>
					  </div>
					<?php } ?>
					</div>
			</div>
		</div>
		</div>
	</div>



<?php
   include ('includes/modal.php');
   include ('includes/footer.php');

?>

  	<script>



</script>
	
