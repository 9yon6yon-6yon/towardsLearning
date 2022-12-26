<?php
include('includes/theader.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);
$id =  $row['id'];

$u_id = $_GET['p_ID'];
$ques = mysqli_query($db,  "SELECT *  FROM `fcourses` f
        JOIN `teacher` t ON f.tid=t.id
        JOIN `subjects` sub ON f.pcat=sub.Subject_Name WHERE f.pid='$u_id'") or die(mysqli_error($db));
$q = mysqli_fetch_assoc($ques);
?>

<div class="contains">
    <div class="qsn-view">
        <div class="qsn">
            <div class="qsn-info">
                <div class="img-poster">
                    <img src="./uploads/<?php echo $q['profile_pic']; ?>" class="rounded-circle " height="35" width="35" alt="" loading="lazy" style="margin-right: 20px;" />
                    <div class="qsn-poster">
                        <div><?php echo $q['Name']; ?></div>
                    </div>
                </div>

                <div class="status-ind"><?php echo $q['pcat']; ?></div>
            </div>

            <div class="qsn-main">
            <div><h2><?php echo $q['product']; ?></h2></div>
                <p><?php echo $q['pinfo']; ?></p>
            </div>
            <div class="qsn_img" style="margin-bottom: 30px;">
                <img src="./uploads/<?php echo $q['pimage']; ?>">
            </div>
            <div><p>Price : <?php  echo $q['price'];?></p></div>
        </div>
        <span class="hr-line"></span>

    </div>

</div>


<?php
include('includes/modal.php');
include('includes/footer.php');
?>