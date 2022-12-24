<?php
include('includes/theader.php');
include('includes/tnavbar.php');

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$statusMsg = '';

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}





$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

?>
<div class="edit-form">
  <div class="container" style="background: linear-gradient(45deg, #daecff, transparent);">
    <div class="avatar">
      <img src="./uploads/<?php echo $row['profile_pic']; ?>">
    </div>
    <div class="title"><?php echo $row['Name']; ?>, Update Information</div>
    <div class="content">
      <form method="post" enctype="multipart/form-data" action="edit-t-profile.php">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" value="<?php echo $row['Name']; ?>" name="fullname">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" value="<?php echo $row['Email']; ?>" name="email">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" value="<?php echo $row['phone']; ?>" name="phone">
          </div>
          <div class="input-box">
            <span class="details">Password</span>

            <input type="text" value="<?php echo ''; ?>" name="password">
          </div>
          <div class="input-box">
            <span class="details">Upload Profile Picture</span>
            <input type="file" name="uploadfile" class="form-control">
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Update">
        </div>
      </form>
      <?php
      if (isset($_POST['submit'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./uploads/" . $filename;
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = md5($_POST['password']);
        if (empty($filename)) {
          $query2 = "UPDATE teacher SET Name = '$name', phone = '$phone', Email = '$email', Password='$password'
          WHERE Name='$username'";
        } else {
          $query2 = "UPDATE teacher SET Name = '$name', profile_pic='$filename', phone = '$phone', Email = '$email', Password='$password'
                      WHERE Name='$name';";
          if (move_uploaded_file($tempname, $folder)) {
            echo "<center>Successfully done uploading</center>";
          } else {
            echo "<center>  Failed to upload image!</center>";
          }
        }
        $result = mysqli_query($db, $query2) or die(mysqli_error($db));
        if ($result) {
          echo "<div class='form'>
          <center>Account Info Updated successfully.</center><br/>
                  </div>
                  ";
        }
      } ?>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>