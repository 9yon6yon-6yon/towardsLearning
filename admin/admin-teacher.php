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
  <title>Bootstrap Example</title>
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
	  <h2 style="margin-bottom: 50px;">New Teachers Applied</h2>

	  <table class="table">
		  <thead class="table-dark">
		    	<tr>
		    		<td>#</td>
		    		<td>Avatar</td>
		    		<td>ID</td>
		    		<td>Name</td>
		    		<td>Email</td>
		    		<td>Education</td>
		    		<td>Phone</td>
		    		<td>Resume</td>
		    		<td class="text-center">Action</td>
		    	</tr>
		  </thead>

		  <?php 
		  $stu = mysqli_query($db,"SELECT * FROM teacher where status='Approved'")or die(mysqli_error($db));

		  $count = 1;
		  ?>
		  <tbody>
		  	<?php
		  	while($s = mysqli_fetch_assoc($stu))
          {

		   ?>
		  	<tr>
		  		<td><?php echo $count ?></td>
		  		<td><img src="../uploads/<?php echo $s['profile_pic']; ?>" height="50" width="50" alt=""
              loading="lazy"/></td>
		    	<td><?php echo $s['id']; ?></td>
		    	<td><?php echo $s['Name']; ?></td>
		    	<td><?php echo $s['Email']; ?></td>
		    	<td><?php echo $s['Education']; ?></td>
		    	<td><?php echo $s['phone']; ?></td>
		    	<td><img src="../uploads/<?php echo $s['cv']; ?>" height="50" width="50" alt=""
              loading="lazy" id="myImg"/></td>
		    	<td class="text-center d-flex justify-content-center align-items-center"><form action="admin-process.php" method="POST">
		    		<input type="text" name="st_id" value="<?php echo $s['id']; ?>" style= "display: none;">
		    		<button type="submit" class="btn btn-primary" formaction="view/teacherview.php?ID=<?php echo $s['id']; ?>" name="res_view">view resume</button>
		    		<input type="submit" class="btn btn-success" value="Edit" name="teacher-edit">
		    		<input type="submit" class="btn btn-danger" value="Delete" name="teacher-delete">
		    	</form></td>
		  	</tr>
		  	<?php
		  	$count++;
		  	?>
		  	<div id="myModal" class="modal">
			  <span class="close">&times;</span>
			  <img class="modal-content" id="img01">
			  <div id="caption"></div>
			</div>
		  	<?php
		  }
		  ?>
		    
		  </tbody>
		</table>

	  
	  
	</div>
</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script>
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById("myImg");
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
		  modal.style.display = "block";
		  modalImg.src = this.src;
		  captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		  modal.style.display = "none";
		}
	</script>

</body>
</html>