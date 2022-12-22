<?php 
  include ('includes/header.php');
  include ('includes/navbar.php');


  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
  $t_id= $_REQUEST['ID'];
  $t_name= $_REQUEST['Name'];
?>

	<div class="contains">
		<div class="appointment-section">
		<div class="appointment-title">
			<h3>Want Some Professional Instructions & Advising?</h3>
			<h4>Hire Our Instructors Now!</h4>
		</div>

		<div class="teachers-info">
			<div class="teacher-card">
				<h4>Set Up a Meeting (Pick Date & Time)</h4>
				<form method="post" action="process.php" enctype="multipart/form-data">
		          <div class="mb-3">
		            <label for="recipient-name" class="col-form-label">Write a Message</label>
		            <input type="text" class="form-control" id="recipient-name" name="answer" required>
		            <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>" >
		            <input type="hidden" name="s_name" value="<?php echo $row['Full_Name']; ?>" >
		            <input type="hidden" name="t_id" value="<?php echo $t_id; ?>" >
		            <input type="hidden" name="t_name" value="<?php echo $t_name; ?>" >
		          </div>
		          <div class="mb-3">
		            <label for="message-text" class="col-form-label">Pick Date</label>
		            <input type="datetime-local" class="form-control" id="message-text" name="date-time" required>
		          </div>
		          <div class="mb-3">
		            <select class="form-select" aria-label="Default select example">
					  <option selected>Select Preferable Online Method</option>
					  <option value="1">Google Meet</option>
					  <option value="2">Skype</option>
					  <option value="3">Zoom</option>
					</select>
		          </div>
		        <button type="submit" class="btn btn-primary" name="appoint-post">Get Appointment</button>
		        </form>
		        <p style="margin-top: 20px; font-size: 14px;" class="text-center">We will notify the teacher about the appointment</p>
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
	
