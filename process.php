<?php

require_once('config.php');

session_start();


$username = "";
$email    = "";

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  $query = "INSERT INTO `students` ( `username` , `Email` , `Password` )  VALUES ('$username', '$email', '$password');";
  $result =  mysqli_query($db, $query);
  if ($result == false) {
    printf("error: %s\n", mysqli_error($db));
  } else echo 'done';
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['success'] = "You are now logged in";
  header('location: dashboard.php');
}

if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  $query = "SELECT * FROM `students` WHERE Email='$email' AND Password='$password';";

  $results = mysqli_query($db, $query);
  $row = mysqli_fetch_array($results);
  if (mysqli_num_rows($results) == 1) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: dashboard.php?$username');
  } else {
    echo "<script>alert('Incorrect Information');
                          window.location = 'login.php';
                  </script>";
  }
}
if (isset($_POST['login_teacher'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  $query = "SELECT * FROM `teacher` WHERE Email='$email' AND Password='$password';";

  $results = mysqli_query($db, $query);
  $row = mysqli_fetch_array($results);
  if (mysqli_num_rows($results) == 1) {
    $_SESSION['username'] = $row['Name'];
    $_SESSION['email'] = $email;
    if ($row['status'] == 'Approved') {
      $_SESSION['success'] = "You are now logged in";
      header('location: teacher-dashboard.php?$username');
    } else {
      echo "<script>alert('You are not approved yet');</script>";
      header('location: teacher-login.php');
    }
  } else {
    echo "<script>alert('Incorrect Information');
                          window.location = 'teacher-login.php';
                  </script>";
  }
}

if (isset($_POST['login_admin'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  $query = "SELECT * FROM admin WHERE Email='$email' AND Password='$password';";
  $results = mysqli_query($db, $query);
  $row = mysqli_fetch_array($results);
  if (mysqli_num_rows($results) == 1) {
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: admin.php?$email');
  } else {
    echo "<script>alert('Incorrect Information');
                          window.location = 'admin-login.php';
                  </script>";
  }
}

if (isset($_POST['post'])) {
  $points = $_POST['point'];
  if (intval($points) >= 10) {

    $details =  $_POST['details'];
    $subject =  $_POST['subject'];
    $points = $_POST['point'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./uploads/" . $filename;
    $sid = $_POST['s_id'];
    $st_points = $_POST['st_point'];

    $current_point = $st_points - intval($points);

    if (intval($current_point) >= 0) {
      $query = "INSERT INTO `questions` (`question_detail`, `question_img`, `ques_points`, `subject_code`, `student_id`) 
            VALUES('$details', '$filename','$points', '$subject', '$sid' );";
      $update = mysqli_query($db, "UPDATE students SET points = '$current_point' WHERE id='$sid'") or die("Query Unsuccessful.");
      mysqli_query($db, $query);
      if (move_uploaded_file($tempname, $folder)) {
        echo "";
      } else {
        echo "<h3>  Failed to upload image!</h3>";
      }
      header('location: dashboard.php');
    } else {
      echo "<script>alert('You have Insufficent Points');
                          window.location = 'dashboard.php';
                  </script>";
    }
  } else {
    echo "<script>alert('Given Points must be greater than or equal to 10');
                          window.location = 'dashboard.php';
                  </script>";
  }
}

if (isset($_POST['ans-post'])) {
  $answer =  $_POST['answer'];
  $points =  $_POST['qu_point'];
  $Solution =  $_POST['solution'];
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "./uploads/" . $filename;
  $sid = $_POST['s_id'];
  $qid = $_POST['qu_id'];
  $st_points = $_POST['st_point'];

  $current_point = $st_points + intval($points);
  $query = "INSERT INTO `solutions` (`answer`, `Solution`, `sol_img`, `ques_id`, `student_id`) 
          VALUES('$answer','$Solution', '$filename', '$qid', '$sid' );";

  if (mysqli_query($db, $query)) {
    $update = mysqli_query($db, "UPDATE students SET points = '$current_point' WHERE id='$sid'") or die("Query Unsuccessful.");
    $update2 = mysqli_query($db, "UPDATE questions SET Status = 'Answered' WHERE q_id='$qid'") or die("Query Unsuccessful.");
  }
  if (move_uploaded_file($tempname, $folder)) {
    echo "";
  } else {
    echo "<h3>  Failed to upload image!</h3>";
  }

  header('location: dashboard.php');
}



if (isset($_REQUEST["term"])) {

  $sql = "SELECT * FROM questions WHERE question_detail LIKE ?";

  if ($stmt = mysqli_prepare($db, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_term);

    $param_term = $_REQUEST["term"] . '%';
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
        $concat = "....";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<p><a href='question.php?Question_ID=" . $row['q_id'] . "'>" . substr($row["question_detail"], 0, 80) . $concat . "</a></p>";
        }
      } else {
        echo "<p>No matches found</p>";
      }
    } else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
  }

  mysqli_stmt_close($stmt);
}

if (isset($_POST['teacherapply'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $subject = mysqli_real_escape_string($db, $_POST['subject']);
  $education = mysqli_real_escape_string($db, $_POST['education']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $pass = md5(mysqli_real_escape_string($db, $_POST['password']));

  $uploadcv = $_FILES["uploadcv"]["name"];
  $tempcv = $_FILES["uploadcv"]["tmp_name"];
  $folder = "./uploads/" . $uploadcv;

  $uploadpic = $_FILES["uploadpic"]["name"];
  $temppic = $_FILES["uploadpic"]["tmp_name"];
  $folder2 = "./uploads/" . $uploadpic;



  $query = "INSERT INTO `teacher` (`Name`, `Email`, `Subject`, `Education`, `phone`, `address`, `profile_pic`, `cv`, `Password`) 
          VALUES('$name', '$email', '$subject','$education','$phone','$address', '$uploadpic', '$uploadcv' , '$pass');";
  mysqli_query($db, $query);
  if (move_uploaded_file($tempcv, $folder) && move_uploaded_file($temppic, $folder2)) {
    echo "<script>alert('Your Application Has been Placed. Please wait until approval');
                          window.location = 'teacher-apply.php';
                  </script>";
  } else {
    echo "<h3>  Failed to upload image!</h3>";
  }
}



if (isset($_POST['appoint-post'])) {
  $t_id = $_POST['t_id'];
  $s_id = $_POST['s_id'];
  $name = $_POST['s_name'];
  $date = $_POST['date-time'];
  $tname = $_POST['t_name'];


  $query = "INSERT INTO appointments (studentName, st_id, teacher_id, time, teacherName) 
          VALUES('$name', '$s_id', '$t_id','$date', '$tname')";
  if (mysqli_query($db, $query)) {
    echo "<script>alert('Your Appointment Has been Placed. Please wait until our instrcutor reach you');
                          window.location = 'dashboard.php';
                  </script>";
  } else {
    echo "<h3>  Failed to get appointment</h3>";
  }
}

if (isset($_POST['blogSubmit'])) {
  $title = dataFilter($_POST['blogTitle']);
  $content = $_POST['blogContent'];
  $userName = $_SESSION['username'];
  $sql = "INSERT INTO `blogdata` (`blogUser`, `blogTitle`, `blogContent`)
		    VALUES ('$userName', '$title', '$content');";
  $result = mysqli_query($db, $sql);

  if (!$result) {
    $_SESSION['message'] = "Some Error occurred !!!";
    header("location: errors.php");
  } else {
    header('location: blogView.php');
  }
}

function dataFilter($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
