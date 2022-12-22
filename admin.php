<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: admin-login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: index.html");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/admin.css">
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
	  <a class="active" href="admin.php">Dashboard</a>
	  <a href="admin/admin-approval.php">Teacher Approval</a>
	  <a href="admin/admin-users.php">Students</a>
	  <a href="admin/admin-teacher.php">Teachers</a>
	  <a href="admin/admin-question.php">Questions</a>
	  <a href="logout.php">Logout</a>

	</div>

	<div class="content">
	  <h2>Dashboard</h2>

	  <div class="cards">
	  	<div class="half">
	  		<div class="info-cards" style="background: #ffcc6f">
		  			<span><i class="fas fa-users"></i></span>
				  	<h1>100+</h1>
				  	<p>Students</p>
			  </div>
			  <div class="info-cards" style="background: #86dd95">
		  			<span><i class="fas fa-chalkboard-teacher"></i></span>
				  	<h1>100+</h1>
				  	<p>Teachers</p>
			  </div>
			  <div class="info-cards" style="background: #ff2c7a">
		  			<span><i class="fas fa-question-circle"></i></span>
				  	<h1>100+</h1>
				  	<p>Questions</p>
			  </div>
		  </div>
		  <div class="half">
			  <div class="info-cards" style="background: #3699ff">
		  			<span><i class="fas fa-square-root-alt"></i></span>
				  	<h1>100+</h1>
				  	<p>Solutions</p>
			  </div>
			  <div class="info-cards" style="background:#d177ff">
		  			<span><i class="fas fa-user-astronaut"></i></span>
				  	<h1>100+</h1>
				  	<p>New Mentors</p>
			  </div>
			  <div class="info-cards" style="background: #5847b9">
		  			<span><i class="fas fa-smile"></i></span>
				  	<h1>Highly</h1>
				  	<p>Positive Reviews</p>
			  </div>
		   </div>

	  </div>
	  
	</div>
</div>

</body>
</html>