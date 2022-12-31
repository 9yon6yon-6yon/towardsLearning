<?php
include('includes/header.php');
include('includes/navbar.php');


$query = mysqli_query($db, "SELECT * FROM students where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

$bid = $row['id'];
if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];

	$sql = "INSERT INTO mycart (bid,pid)
               VALUES ('$bid', '$pid')";
	$result = mysqli_query($conn, $sql);
}

?>
<!-- One -->
<section id="main" class="wrapper style1 align-center">
	<div class="container">
		<h2>My Cart</h2>

		<section id="two" class="wrapper style2 align-center">
			<div class="container">
				<div class="row">
					<?php
					$sql = "SELECT * FROM `mycart` WHERE bid = '$bid'";
					$result = mysqli_query($conn, $sql);
					while ($row = $result->fetch_array()) :
						$pid = $row['pid'];
						$sql = "SELECT * FROM `fcourses` WHERE pid = '$pid'";
						$result1 = mysqli_query($conn, $sql);
						$row1 = $result1->fetch_array();
						$picDestination = "./uploads/" . $row1['pimage'];
					?>
						<div class="col-md-4">
							<section>
								<strong>
									<h2 class="title" style="color:black; "><?php echo $row1['product'] . ''; ?></h2>
								</strong>
								<div style="align: left">
									<blockquote><?php echo "Type : " . $row1['pcat'] . ''; ?><br><?php echo "Price : " . $row1['price'] . ' /-'; ?><br></blockquote>

							</section>
						</div>

					<?php endwhile;	?>



				</div>

		</section>
		</header>

</section>
<?php
include('includes/modal.php');
include('includes/footer.php');

?>