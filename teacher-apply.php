<?php

require_once('config.php');

$query=mysqli_query($db,"SELECT * FROM subjects")or die(mysqli_error($db));

?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

	  <link rel="preconnect" href="https://fonts.googleapis.com">
	  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  	<header style="position: relative !important;">
		<a href="#" class="logo">
			<img src="img/logo.png">
		</a>

		<ul class="navbar">
			<li><a href="#home">Home</a></li>
			<li><a href="#">For Teachers</a></li>
			<li><a href="#">For Students</a></li>
			<li><a href="login.php">Log in</a></li>
			<li><a href="signup.php">Sign up</a></li>
		</ul>

		<div class="header-icons">
			<a href="#"><i class='bx bx-user'></i></a>
			
			<div class="bx bx-menu" id="menu-icon"></div>
		</div>
	</header>

    <div class="container">
    	<form action="process.php" method="POST" enctype="multipart/form-data">
		  <div class="row d-flex justify-content-around">
		  	<div class=" mt-5 mb-5 col-12 d-flex justify-content-center">
		  		<div class="fs-3">Apply As a Teacher</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="email" class="form-label">Name:</label>
			    	<input type="text" class="form-control" id="email" placeholder="Enter Your Name" name="name">
			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="email" class="form-label">Email:</label>
			    	<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="email" class="form-label">Address:</label>
			    	<input type="text" class="form-control" id="email" placeholder="Enter Address" name="address">
			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="email" class="form-label">Contact Number:</label>
			    	<input type="text" class="form-control" id="email" placeholder="Enter Phone Number" name="phone">
			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="email" class="form-label">Education Qualification:</label>
			    	<input type="text" class="form-control" id="email" placeholder="Enter Education Qualification" name="education">
			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
		  			<label for="email" class="form-label">Which Subject You Wanna Teach?</label>
			  		<select class="form-select" aria-label="Default select example" name="subject">
						  <option selected>Choose Your Favourite Subject</option>
						  <?php
						  while($q = mysqli_fetch_assoc($query)){
						  	?>
						  	<option value="<?php echo $q['Subject_Name'] ?>" ><?php echo $q['Subject_Name'] ?></option>
						  	<?php
						  }


						  	?>
					</select>
				</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="formFile" class="form-label">Upload Your CV</label>
  					<input class="form-control" type="file" id="formFile" name="uploadcv">

			 	</div>
		  	</div>
		  	<div class="col-5">
		  		<div class="mb-3 mt-3">
			    	<label for="formFile2" class="form-label">Choose Profile Picture</label>
  					<input class="form-control" type="file" id="formFile2" name="uploadpic">

			 	</div>
		  	</div>

		  	<div class="col-6">
		  		<div class="mb-3 mt-3 px-5 d-flex justify-content-center">
		  	 		<button type="submit" class="btn btn-primary px-5" name="teacherapply">Submit</button>
		  	 	</div>
		  	</div>
		  </div>
		</form>
    </div>

    
<section class="contact" id="contact" style="background: #7ca5ff !important;">
		<div class="main-contact">
			<div class="contact-content">
				<img src="img/logo.png">
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Instagram</a></li>
				<li><a href="#">Twitter</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#home">Home</a></li>
			  <li><a href="#categories">Categories</a></li>
			  <li><a href="#courses">Courses</a></li>
			  <li><a href="#about">About Us</a></li>
			  <li><a href="#contact">Contact</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#">Profile</a></li>
				<li><a href="#">Login</a></li>
				<li><a href="#">Register</a></li>
				<li><a href="#">Instructor</a></li>
				<li><a href="#">Dashboard</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#">Madani Avenue<br> Badda, Dhaka 1260</a></li>
			
				<li><a href="#">016XXXXXXXX</a></li>
			</div>

		</div>
	</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>


</body>
</html>