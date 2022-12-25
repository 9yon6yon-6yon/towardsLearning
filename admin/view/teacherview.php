<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'towardsLearning');

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['res_view'])) {
  $q_id = mysqli_real_escape_string($db, $_POST['st_id']);
  $query = mysqli_query($db,"SELECT * FROM teacher WHERE id='$q_id'");
    if ($s = mysqli_fetch_assoc($query)) {

    	?>
    		<div style="width: 80%; margin:auto;">
    			<div style="display: flex; justify-content: center; width: 100%;">
          <a href="http://localhost/towardsLearning/uploads/<?php echo $s['cv'];?>" alt="resume" style="width: auto; max-height: 700px;"><img src="../../img/cv.jpg" height="50" width="50" alt="" loading="lazy"></a>
    			</div>
    			<div style="display: flex; justify-content: center; width: 100%;"><a href="../admin-approval.php" style="text-decoration: none; font-size: 1.5em; color: black; font-family: sans-serif; margin-top: 30px; cursor: pointer;">Go Back</a></div>
    		</div>

    	<?php

    }
    else {
       echo "Error getting record: " . mysqli_error($db);
     }
 }
     ?>