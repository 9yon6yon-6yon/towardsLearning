<?php 
  include ('includes/header.php');
  include ('includes/navbar.php');
  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
  $id=  $row['id'];

  $ques_count=mysqli_query($db,"SELECT COUNT(question_detail) FROM questions where student_id='$id'")or die(mysqli_error($db));
  $qc=mysqli_fetch_array($ques_count);

  $sol_count=mysqli_query($db,"SELECT COUNT(answer) FROM solutions where student_id='$id'")or die(mysqli_error($db));
        $ac=mysqli_fetch_array($sol_count);
  ?>

  <div class="d-block">
  	<img src="img/wallpaper_english.svg" height="auto" width="100%">
  </div>

  <div class="jinispotro">
  	 <div class="profile-card">
        <div class="img-user">
          <div class="user-img">
          <img src="./uploads/<?php echo $row['img']; ?>"class="rounded-circle " height="24" width="24" alt=""
              loading="lazy" /></div>
          <div class="lit-det">
            <span class="lit-user"><?php echo $row['username']; ?></span>
          
          <div class="point-bar"><i class="fas fa-star"></i><span class=""><?php echo $row['points']; ?> points</div>
          </div>
        </div>
        <div class="email-point">
          <span class="rank" ><?php echo $row['Rank']; ?></span>
        </div>
        <span class="hr-line" style="margin-top: 30px;"></span>
        <div class="info-section">
        	<div class="ans-count">
        		<p>Answers</p>
        		<p><?php echo $ac['0']; ?></p>
        	</div>
        	<hr width="3" size="40" style="width: auto; background: black;">
        	<div class="ques-count">
        		<p>Questions</p>
        		<p><?php echo $qc['0']; ?></p>
        	</div>
        </div>


        <div class="p-btn"><a href="editprofile.php" class="p-btn-des"><i class="fas fa-pencil-alt"></i>  edit Profile</a></div>

        <div class="about">
        	<h4>About</h4>
        	<span class="hr-line" style="margin-top: 10px;"></span>
        	<div class="about-lines">
        		<div>
        			<i class="fas fa-user-graduate"></i>
        			<div> Level: <span> Secondary School</span></div>
        		</div>
        		<div>
        			<i class="fas fa-calendar-alt"></i>
        			<div> Joined: <span> 13 Spetember 2022</span></div>
        		</div>
        	</div>
        </div>

      </div>
  	<div class="ques-ans-area">

  		<div class="tabus">
	    <input type="radio" name="slider" checked id="home">
	    <input type="radio" name="slider" id="blog">
	    <nav>
	      <label for="home" class="home"><i class="fas fa-question-circle"></i>Your Questions</label>
	      <label for="blog" class="blog"><i class="fas fa-square-root-alt"></i>Your Answers</label>
	      
	    </nav>
	    <section>
	      <div class="content content-1">
	        <?php 
        $ques = mysqli_query($db,"SELECT q_id, question_detail, Subject_Name, id  FROM questions q
       JOIN students s ON q.student_id=s.id
       JOIN subjects sub ON q.subject_code=sub.s_code where q.student_id = '$id' ")or die(mysqli_error($db));
      if($rowcount=mysqli_num_rows($ques)>0){

      while($q = mysqli_fetch_assoc($ques))
          {
            
            ?>
      <div class="question" id = "response">
        <div class="infos">
          <div class="info-title" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
              <div class="subject"><?php echo $q['Subject_Name']; ?></div>
          </div>
        </div>
        <div><a href="question.php?Question_ID=<?php echo $q['q_id'] ?>" class="ques_det"> <?php if(strlen($q['question_detail'])>150){ echo substr($q['question_detail'], 0, 150);} else { echo $q['question_detail'];}  ?> </a></div>
        <span class="hr-line"></span>
      </div>
      <?php
          }
        }
        else {
          ?>
          <div class="title">No Questions Asked yet</div>
          <?php
        }
    ?>
	      </div>
	      <div class="content content-2">
	        <?php 
        $soln = mysqli_query($db,"SELECT ques_id, question_detail, answer FROM solutions s
       JOIN questions q ON q.q_id=s.ques_id
       where s.student_id = '$id'")or die(mysqli_error($db));
      if($rc=mysqli_num_rows($soln)>0){

      while($s = mysqli_fetch_assoc($soln))
          {
            
            ?>
      <div class="question" id = "response">
        <h6 class="subject">Question</h6>
        <div style=" margin-bottom: 10px;"><a href="question.php?Question_ID=<?php echo $s['ques_id'] ?>" class="ques_det"> <?php if(strlen($s['question_detail'])>120){ echo substr($s['question_detail'], 0, 120);} else { echo $s['question_detail'];}  ?> </a></div>

        <div class="infos">
          <div class="info-title" >
              <h6 class="subject">Your Answer</h6>
              <div ><?php echo $s['answer']; ?></div>
          </div>
        </div>
        
        <span class="hr-line"></span>
      </div>
      <?php
          }
        }
        else {
          ?>
          <div class="title">No Answeres Given Yet</div>
          <?php
        }
    ?>
	      </div>
	    </section>
	  </div>
	  		
	  	</div>
  </div>


  
   <?php
   include ('includes/modal.php');
   include ('includes/footer.php');
?>