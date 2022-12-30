<?php
include('includes/header.php');
include('includes/navbar.php');
$query = mysqli_query($db, "SELECT * FROM students where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

$sql = "SELECT * FROM files";
$result = mysqli_query($db, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM fcourses";
$result2 = mysqli_query($db, $sql2);
$files2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);



if (!empty($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE fileid=$id";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = './uploads/' . $file['name'];

    if (file_exists($filepath)) {
        // header("Cache-Control: public");
        // header("Content-Disposition: attachment; filename=$file");
        // header("Content-Type: " . mime_content_type($filepath));
        // header("Content-Transfer-Encoding: binary");
        // header('Content-Length: ' . filesize($filepath));
        // // ob_clean();
        // // flush();
        // readfile($filepath);
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE fileid=$id";
        mysqli_query($db, $updateQuery);
        exit;
    }
}
?>
<form  style="padding-top: 20px; padding-left: 50px;">
    <div class="main-area" >
        <div class="question" id="response" style="width: 70%">
            <div class="row uniform" style="padding-top: 20px; padding-bottom: 50px;">
                <center><h3>Lecture Videos</h3></center>
                <table>
                    <thead>
                        <th style="padding-left:30px;padding-top:10px;">ID</th>
                        <th>Filename</th>
                        <th>Catagory</th>
                        <th>size</th>
                        <th>Downloads</th>

                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file) : ?>
                            <td style="padding-left:30px;"><?php echo $file['fileid']; ?></td>
                            <td><a href="vVideos.php?_fileName=<?php echo $file['name']; ?>"><?php echo $file['name']; ?></a></td>
                            <td><?php echo $file['pcat']; ?></td>
                            <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                            <td><?php echo $file['downloads']; ?></td>
                            <td><a href="http://localhost/towardsLearning/uploads/<?php echo $file['name'] ?>" >Download</a></td>
                            <a href="videodownload.php?file_id=<?php echo $file['fileid'] ?>"></a>
                        
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row uniform"  style="padding-top: 20px; padding-bottom: 50px;">
            <center><h3>Courses</h3></center>
                <table>
                    <thead>
                        <th style="padding-left:30px;padding-top:10px;">ID</th>
                        <th>Name</th>
                        <th>Catagory</th>
                        <th>Price</th>
                        <th>View</th>
                    </thead>
                    <tbody>
                        <?php foreach ($files2 as $file2) : ?>
                            <td style="padding-left:30px;"><?php echo $file2['pid']; ?></td>
                            <td><a href="vCourses.php?_course=<?php echo $file2['product']; ?>"><?php echo $file2['product']; ?></a></td>
                            <td><?php echo $file2['pcat']; ?></td>
                            <td><?php echo $file2['price']; ?></td>
                            <td><a href="http://localhost/towardsLearning/uploads/<?php echo $file2['pimage'] ?>">Watch</a></td>
                            </tr>
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