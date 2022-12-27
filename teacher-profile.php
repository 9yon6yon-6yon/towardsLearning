<?php
include('includes/theader.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);
$id =  $row['id'];


$courses_count = mysqli_query($db, "SELECT COUNT(pid) FROM `fcourses` where tid='$id'") or die(mysqli_error($db));
$cc = mysqli_fetch_array($courses_count);

$video_count = mysqli_query($db, "SELECT COUNT(fileid) FROM `files` where tid='$id'") or die(mysqli_error($db));
$vc = mysqli_fetch_array($video_count);
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
        <span class="hr-line" style="margin-top: 30px;"></span>
        <div class="info-section">
            <div class="ans-count">
                <p>Courses </p>
                <p><?php echo $cc['0']; ?></p>
            </div>
            <hr width="3" size="40" style="width: auto; background: black;">
            <div class="ques-count">
                <p>Videos</p>
                <p><?php echo $vc['0']; ?></p>
            </div>
        </div>
        <div class="p-btn"><a href="edit-t-profile.php" class="p-btn-des"><i class="fas fa-pencil-alt"></i> Edit Profile</a></div>

        <div class="about">
            <h4>About</h4>
            <span class="hr-line" style="margin-top: 25px;"></span>
            <div class="about-lines">
                <div>
                    <i class="fas fa-user-graduate"></i>
                    <div> <?php echo $row['Education']; ?></div>
                </div>
                <div>
                    <i class="fas fa-phone-alt"></i>
                    <div> <?php echo $row['phone']; ?></div>
                </div>
            </div>
        </div>

    </div>
    <div class="ques-ans-area">

        <div class="tabus">
            <input type="radio" name="slider" checked id="home">
            <input type="radio" name="slider" id="blog">
            <nav>
                <label for="home" class="home"><i class="fas fa-question-circle"></i>Courses</label>
                <label for="blog" class="blog"><i class="fas fa-square-root-alt"></i>Videos</label>

            </nav>
            <section>
                <div class="content content-1">
                    <?php
                    $ques = mysqli_query($db, "SELECT *  FROM `fcourses` f
   JOIN `teacher` t ON f.tid=t.id
   JOIN `subjects` sub ON f.pcat=sub.Subject_Name where f.tid = '$id' ") or die(mysqli_error($db));
                    if ($rowcount = mysqli_num_rows($ques) > 0) {

                        while ($q = mysqli_fetch_assoc($ques)) {

                    ?>
                            <div class="question" id="response">
                                <div class="infos">
                                    <div class="info-title" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <div class="subject"><?php echo $q['pcat']; ?></div>
                                    </div>
                                </div>
                                <div><a href="detailedview.php?p_ID=<?php echo $q['pid'] ?>" class="ques_det"> <?php if (strlen($q['pinfo']) > 150) {
                                                                                                                    echo substr($q['pinfo'], 0, 150);
                                                                                                                } else {
                                                                                                                    echo $q['pinfo'];
                                                                                                                }  ?> </a></div>
                                <span class="hr-line"></span>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="title">No Courses uploaded yet</div>
                    <?php
                    }
                    ?>
                </div>
                <div class="content content-2">
                    <?php
                    $soln = mysqli_query($db, "SELECT * FROM `files` f
   JOIN `teacher` t ON f.tid=t.id
   where t.id = '$id'") or die(mysqli_error($db));
                    if ($rc = mysqli_num_rows($soln) > 0) {

                        while ($s = mysqli_fetch_assoc($soln)) {

                    ?>
                            <div class="question" id="response">
                                <div class="infos">
                                    <div class="info-title" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <h6 class="subject"><?php echo $s['pcat']; ?></h6>
                                    </div>
                                    <div style=" margin-bottom: 10px;"><a href="detailedView.php?_ID=<?php echo $s['fileid'] ?>" class="ques_det"> <?php if (strlen($s['pinfo']) > 120) {
                                                                                                                                                echo substr($s['pinfo'], 0, 120);
                                                                                                                                            } else {
                                                                                                                                                echo $s['pinfo'];
                                                                                                                                            }  ?> </a></div>


                                    <div>Downloads : <?php echo $s['downloads']; ?></div>

                                </div>

                                <span class="hr-line"></span>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="title">No videos uploaded Yet</div>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </div>

    </div>
</div>



<?php
include('includes/modal.php');
include('includes/footer.php');
?>