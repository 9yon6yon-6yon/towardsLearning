<?php 
  include 'config.php';
  $username=$_SESSION['username'];
    $email=$_SESSION['email'];


  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);

?>