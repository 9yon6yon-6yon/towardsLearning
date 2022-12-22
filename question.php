<?php 
  include ('includes/header.php');
  include ('includes/navbar.php');

  $query=mysqli_query($db,"SELECT * FROM students where Email='$email'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
  $st_id=  $row['id'];

  $qu_id = $_GET['Question_ID'];
  $ques = mysqli_query($db,"SELECT q_id, Status, question_detail, img, ques_points, username, Subject_Name, created_at, question_img, id  FROM questions q
       JOIN students s ON q.student_id=s.id
       JOIN subjects sub ON q.subject_code=sub.s_code WHERE q.q_id='$qu_id'")or die(mysqli_error($db));
       date_default_timezone_set("Asia/Dhaka");
		$q = mysqli_fetch_assoc($ques);
            $now = new DateTime();
            $p= new DateTime($q['created_at']);
            $interval = $now->diff($p);
  ?>

  <div class="contains">
  	<div class="qsn-view">
  		<div class="qsn">
  			<div class="qsn-info">
  				<div class="img-poster">
  					<img src="./uploads/<?php echo $q['img']; ?>" class="rounded-circle " height="35" width="35" alt=""
              loading="lazy" style= "margin-right: 20px;"/>
	              <div class="qsn-poster">
	              	<div><?php echo $q['username']; ?></div>
	              	<div><?php echo ($interval->format("%a") * 24) + $interval->format("%h"). " hours". $interval->format(" %i minutes "); ?> ago</div>
	              </div>
  				</div>
	              <div class="status-ind"><?php echo $q['Status']; ?></div>
  			</div>
  			<div class="qsn-main">
  				<h2><?php echo $q['question_detail']; ?></h2>
  			</div>
  			<div class="qsn_img" style="margin-bottom: 30px;">
  				<img src="./uploads/<?php echo $q['question_img']; ?>">
  			</div>
  			<?php if($q['Status']=="Unanswered" && $q['id']!=$st_id){ ?>
  			<button type="button" class="answer-btn" data-bs-toggle="modal" data-bs-target="#exampleModal2">Answer
			</button>
  			<?php } else{ ?>
  				<div class="answer-btn">Check Answer Below</div>
  				<?php
  			}?>
  		</div>
  		<span class="hr-line"></span>

<?php
  		$sol = mysqli_query($db,"SELECT ques_id,answer, Solution, img, username, created_at, sol_img, id  FROM solutions s
       JOIN students st ON s.student_id=st.id WHERE s.ques_id='$qu_id'")or die(mysqli_error($db));
  		if($rowcount=mysqli_num_rows($sol)==1){
		$sol_row = mysqli_fetch_assoc($sol);
		$sol_id=  $sol_row['id'];

		$now2 = new DateTime();
        $p2= new DateTime($sol_row['created_at']);
        $interval2 = $now2->diff($p2);

			$sol_count=mysqli_query($db,"SELECT COUNT(answer) FROM solutions where student_id='$sol_id'")or die(mysqli_error($db));
			  $qc=mysqli_fetch_array($sol_count);
		  	  	
  ?>
  	<div class="ans-view">
	  	<div class="qsn">
		  	<div class="qsn-info">
		  		<div class="img-poster">
		  			<img src="./uploads/<?php echo $sol_row['img']; ?>" class="rounded-circle " height="35" width="35" alt=""
		              loading="lazy" style= "margin-right: 20px;"/>
			        <div class="qsn-poster">
			            <div><?php echo $sol_row['username']; ?></div>
			              	<div class="sol_det"><?php echo ($interval2->format("%a") * 24) + $interval2->format("%h"). " hours". $interval2->format(" %i minutes "); ?> ago | Total <?php echo $qc['0']; ?> Question Solved </div>
			        </div>
		  		</div>
		  	</div>
		  	<div class="qsn-main">
		  		<p>Answer: <span><?php echo $sol_row['answer']; ?></span></p>
		  		<h3>Step-by-step explanation:</h3>
		  		<div class="soln"><?php echo $sol_row['Solution']; ?></div>
		  	</div>
		  		<h3>Attached Images:</h3>
		  		<div class="qsn_img" style="margin-bottom: 30px;">
		  			<img src="./uploads/<?php echo $sol_row['sol_img']; ?>">
		  		</div>
	  	</div>		
	</div>

<?php }

	else{
		?>
		<div class="ans-view"><div class="qsn"><h3 style="display: flex;
    justify-content: center;">Not answered Yet</h3></div></div>
		<?php
	}

?>
  		
  	</div>

  	<div class="right-bar" style="width: 26%;">
  		<?php include ('includes/right-sidebar.php'); ?>
  	</div>
  	
  </div>


   <?php
   include ('includes/solution-modal.php');
   include ('includes/modal.php');
   include ('includes/footer.php');
?>