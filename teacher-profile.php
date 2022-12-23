<?php
include('includes/header.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);
$id =  $row['id'];
?>

<div class="jinispotro">
    <div class="profile-card">
        <div class="img-user">
            <div class="user-img">
                <img src="./uploads/<?php echo $row['profile_pic']; ?>" class="rounded-circle " height="24" width="24" alt="" loading="lazy" />
            </div>
            <div class="lit-det">
                <span class="lit-user"><?php echo $row['Name']; ?></span>

                <div class="point-bar"><i class="fas fa-star"></i><span class=""><?php echo $row['status']; ?></div>
            </div>
        </div>
        <div class="email-point">
            <span class="rank"><?php echo $row['Rank']; ?></span>
        </div>
        <span class="hr-line" style="margin-top: 30px;"></span>


        <div class="p-btn"><a href="edit-t-profile.php" class="p-btn-des"><i class="fas fa-pencil-alt"></i> Edit Profile</a></div>

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
        </div>

    </div>
</div>



<?php
include('includes/modal.php');
include('includes/footer.php');
?>