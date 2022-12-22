<?php 
  include ('includes/header.php');
  include ('includes/navbar.php');

  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die();
  $row=mysqli_fetch_array($query);
  ?>
  <div class="main-area">
    <?php include ('includes/left-sidebar.php'); ?>

    <div class="question-area">
      <div class="sm-title">
        <img src="img/brain.png" alt="brain-icon">
        <div>The Brain - Answerer</div>
      </div>
      <div class="big-title">
        <h1>Get Answers for FREE</h1>
        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border-radius: 30px !important;" >Ask your Question</button>
      </div>
      <span class="hr-line"></span>

      <?php 
        $ques = mysqli_query($db,"SELECT q_id, Status, question_detail, img, ques_points, username, Subject_Name, created_at  FROM questions q
       JOIN students s ON q.student_id=s.id
       JOIN subjects sub ON q.subject_code=sub.s_code where sub.s_code = 7 ORDER BY created_at DESC")or die();
      date_default_timezone_set("Asia/Dhaka");
      while($q = mysqli_fetch_assoc($ques))
          {
            $now = new DateTime();
            $p= new DateTime($q['created_at']);
            $interval = $now->diff($p);

            ?>
      <div class="question" id = "response">
        <div class="info">
          <div class="info-title">
            <img src="./uploads/<?php echo $q['img']; ?>"class="rounded-circle " height="35" width="35" alt=""
              loading="lazy" style= "margin-right: 15px;"/>
              <div style="text-transform: capitalize; margin-right: 20px;"><?php echo $q['username']; ?></div>
              <div class="subject"><?php echo $q['Subject_Name']; ?></div>
              <div><?php echo ($interval->format("%a") * 24) + $interval->format("%h"). " hours". $interval->format(" %i minutes "); ?> ago</div>
          </div>
          <div class="point-bar"><i class="fas fa-star"></i><span class=""><?php echo $q['ques_points']; ?> points</div>
        </div>
        <div><a href="question.php?Question_ID=<?php echo $q['q_id']; ?>" class="ques_det"> <?php if(strlen($q['question_detail'])>150){ echo substr($q['question_detail'], 0, 150);} else { echo $q['question_detail'];}  ?> </a></div>
          <div class="last-row"> 
            <div class="status"><?php echo $q['Status']; ?></div>         
            <div class="p-btn ">
              <button type="button" <?php if($q['username']==$row['username'] || $q['Status']=="Answered"){?> disabled="disabled" style="display: none;" <?php } ?> name="answer" class="p-btn-des" style="border: 1px solid black;"><a href="question.php?Question_ID=<?php echo $q['q_id']; ?>" style="text-decoration: none;color: black;">Answer</a></button></div>
          </div>

        <span class="hr-line"></span>
      </div>
      <?php
          }
    ?>
    </div>
    


    <div class="right-sidebar">
      <?php include ('includes/right-sidebar.php'); ?>
    </div>
   </div>

   <?php
   include ('includes/modal.php');
   include ('includes/footer.php');
?>