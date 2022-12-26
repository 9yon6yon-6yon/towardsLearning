
      <div class="profile-card">
        <div class="img-user">
          <div class="user-img">
          <img src="./uploads/<?php if(empty($row['img'])){echo $row['profile_pic']; }else echo $row['img'];?>"class="rounded-circle " height="24" width="24" alt=""
              loading="lazy" /></div>
          <div class="lit-det">
            <span class="lit-user"><?php echo $row['username']; ?></span>
          <span class="rank"><?php echo $row['Rank']; ?></span>
          </div>
        </div>
        <div class="email-point">
          <b>Email: </b> <span style="font-weight: 500;"><?php echo $row['Email']; ?></span><br>
          <div class="point-bar"><i class="fas fa-star"></i><span class=""><?php if(empty($row['points'])){
           echo $row['status']; }else echo $row['points']; ?></div>
        </div>
        <span class="hr-line"></span><div class="p-btn"
      </div>
      <div class="aski-toppers">
        <div class="top-title">
          <span><i class="fas fa-crown"></i></span>
          <p> Top Ranking</p>
        </div>
        <span class="hr-line"></span>

        <?php
          $query2=mysqli_query($db,"SELECT img,points,username FROM students ORDER BY points DESC")or die(mysqli_error($db));
          $count = 0;

          while($i = mysqli_fetch_assoc($query2))
          {
            ?>
            <div class="top-ranked_users">
               <div class="img-name">
                 <img src="./uploads/<?php echo $i['img']; ?>"class="rounded-circle " height="30" width="30" alt=""
                  loading="lazy" />
                  <div class="img-name-size"><?php echo $i['username']; ?></div>
               </div>
            </div>
            <?php
          }
        ?>

        <div class="p-btn"><a href="dashboard.php" class="p-btn-des">Load More</a></div>
      </div>
