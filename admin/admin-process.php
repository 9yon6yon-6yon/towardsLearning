<?php
require_once('../config.php');

if (isset($_POST['ques-delete'])) {
  $q_id = mysqli_real_escape_string($db, $_POST['ques_id']);


    $query = "DELETE FROM questions WHERE q_id='$q_id'";
    if (mysqli_query($db, $query)) {
       echo "Record deleted successfully";
       header('location: admin-question.php');
     } else {
       echo "Error deleting record: " . mysqli_error($db);
     }

mysqli_close($db);
}

if (isset($_POST['cancel'])) {
  $q_id = mysqli_real_escape_string($db, $_POST['st_id']);


    $query = "DELETE FROM teacher WHERE id='$q_id'";
    if (mysqli_query($db, $query)) {
       echo "Record deleted successfully";
       header('location: admin-approval.php');
     } else {
       echo "Error deleting record: " . mysqli_error($db);
     }

mysqli_close($db);
}
if (isset($_POST['approve'])) {
  $q_id = mysqli_real_escape_string($db, $_POST['st_id']);


    $query = "UPDATE teacher SET status = 'Approved' WHERE id='$q_id'";
    if (mysqli_query($db, $query)) {
       echo "Record Approved successfully";
       header('location: admin-approval.php');
     } else {
       echo "Error deleting record: " . mysqli_error($db);
     }

mysqli_close($db);
}


if (isset($_POST['student-delete'])) {
  $s_id = mysqli_real_escape_string($db, $_POST['st_id']);


    $query = "DELETE FROM students WHERE id='$s_id'";
    if (mysqli_query($db, $query)) {
       echo "Record deleted successfully";
       header('location: admin-users.php');
     } else {
       echo "Error deleting record: " . mysqli_error($db);
     }

mysqli_close($db);
}