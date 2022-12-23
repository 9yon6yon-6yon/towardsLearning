<?php
session_start();

require './../config.php';

$sql = "SELECT * FROM blogdata ORDER BY blogId DESC";
$result = mysqli_query($db, $sql);

while ($row = $result->fetch_array()) :
?>

        <?= $row['likes']; ?>

    <?php endwhile; ?>
