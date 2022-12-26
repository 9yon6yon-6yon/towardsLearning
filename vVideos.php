<?php
include('includes/header.php');
include('includes/navbar.php');

$u_id = $_GET['_fileName'];
$ques = mysqli_query($db,  "SELECT *  FROM `files` f
        JOIN `teacher` t ON f.tid=t.id
        JOIN `subjects` sub ON f.pcat=sub.Subject_Name WHERE f.name='$u_id'") or die(mysqli_error($db));
$q = mysqli_fetch_assoc($ques);
?>

<div class="contains">
    <div class="qsn-view">
        <div class="qsn"><h5 style="margin-bottom: 20px;">Uploaded By</h5> 
            <div class="qsn-info">
                <div class="img-poster">  
                    <img src="./uploads/<?php echo $q['profile_pic']; ?>" class="rounded-circle " height="35" width="35" alt="" loading="lazy" style="margin-right: 20px;" />
                    <div class="qsn-poster">
                        <div><?php echo $q['Name']; ?></div>
                    </div>
                </div>
                <div class="status-ind"><?php echo $q['pcat']; ?></div>
                <div class="status-ind">Downloads <?php echo $q['downloads']; ?></div>
            </div>
            <div class="qsn-main">
            <div><h2><?php echo $q['product']; ?></h2></div>
                <p><?php echo $q['pinfo']; ?></p>
            </div>
            <div class="qsn_img" style="margin-bottom: 30px;">
                <img src="./uploads/<?php echo $q['name']; ?>">
            </div>
            <div><p>File size : <?php  echo floor($q['size']/1024) ,'KB';?></p></div>
        </div>
        <span class="hr-line"></span>

    </div>

</div>


<?php
include('includes/modal.php');
include('includes/footer.php');
?>