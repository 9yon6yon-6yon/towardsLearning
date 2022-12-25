<?php
include 'config.php';
if ($db === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['res_view'])) {
  $q_id = $_GET['ID'];
  $query = mysqli_query($db, "SELECT * FROM teacher WHERE id='$q_id'");
  if ($s = mysqli_fetch_assoc($query)) {

?>
    <div style="width: 80%; margin:auto;">
      <div style="display: flex; justify-content: center; width: 100%;">
        <a href="./uploads/<?php echo $s['cv'];?>" alt="resume" style="width: auto; max-height: 700px;"><img src="./img/cv.jpg" height="50" width="50" alt="" loading="lazy"></a>
      </div>
      <div style="display: flex; justify-content: center; width: 100%;"><a href="appointment.php" style="text-decoration: none; font-size: 1.5em; color: black; font-family: sans-serif; margin-top: 30px; cursor: pointer;">Go Back</a></div>
    </div>

<?php

  } else {
    echo "Error getting record: " . mysqli_error($db);
  }
}
?>