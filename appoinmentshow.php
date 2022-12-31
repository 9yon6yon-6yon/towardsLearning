<?php
include('includes/theader.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

$sql = "SELECT * FROM `appointments`";
$result = mysqli_query($db, $sql);
$appmnt = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['cancel'])) {
    $a_id = mysqli_real_escape_string($db, $_POST['ap_id']);

    $query = "DELETE FROM `appointments` WHERE `appointments`.`ap_id` = $a_id" ;
    if (mysqli_query($db, $query)) {
        echo "Record deleted successfully";
        header('location: appoinmentshow.php');
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }

    mysqli_close($db);
}
if (isset($_POST['approve'])) {
    $a_id = mysqli_real_escape_string($db, $_POST['ap_id']);

    $query = "UPDATE `appointments` SET status = 'Approved' WHERE  `appointments`.`ap_id` = $a_id";
    if (mysqli_query($db, $query)) {
        echo "Record Approved successfully";
        header('location: appoinmentshow.php');
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }

    mysqli_close($db);
}


?>
<form style="padding-top: 20px; padding-left: 50px;">
    <div class="main-area">
        <div class="question" id="response" style="width: 70%">
            <div class="row uniform" style="padding-top: 20px; padding-bottom: 50px;">
                <center>
                    <h3>Appointments</h3>
                </center>
                <table>
                    <thead>
                        <th style="padding-left:30px;padding-top:10px;">Student ID</th>
                        <th>Student Name</th>
                        <th>Time</th>
                        <td class="text-center">Action</td>

                    </thead>
                    <tbody>
                        <?php foreach ($appmnt as $appt) :  ?>
                           <?php echo $appt['teacher_id'] == $row['tid']; ?>
                            <?php if ($appt['teacher_id'] == $row['tid']) {
                            } ?>

                            <td style="padding-left:60px;"><?php echo $appt['st_id']; ?></td>
                            <td><?php echo $appt['studentName']; ?></td>
                            <td><?php echo $appt['time']; ?></td>
                            <td class="text-center d-flex justify-content-center align-items-center">
                                <form action="appoinmentshow.php" method="POST">
                                 <input type="text" name="st_id" value="<?php echo $appt['st_id']; ?>" style="display: none;">
                                 <input type="text" name="ap_id" value="<?php echo $appt['ap_id']; ?>" style="display: none;">
                                    <input type="submit" class="btn btn-success" value="Approve" name="approve">
                                    <input type="submit" class="btn btn-danger" value="Cancel" name="cancel">
                                </form>
                            </td>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="right-sidebar">
            <?php include('includes/right-sidebar.php'); ?>
        </div>
</form>

</div>
<span class="hr-line"></span>
<?php
include('includes/modal.php');
include('includes/footer.php');
?>