<?php
include('includes/header.php');
include('includes/navbar.php');
$query = mysqli_query($db, "SELECT * FROM students where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

$sql = "SELECT * FROM files";
$result = mysqli_query($db, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (!empty($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = './uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: " . mime_content_type($filepath));
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize($filepath));
        // ob_clean();
        // flush();
        readfile($filepath);
        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($db, $updateQuery);
        exit;
    }
}
?>
<form>
    <div class="main-area">
        <div class="question" id="response" style="width: 70%">
            <div class="row uniform">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>size</th>
                        <th>Downloads</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file) : ?>
                            <td><?php echo $file['id']; ?></td>
                            <td><?php echo $file['name']; ?></td>
                            <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                            <td><?php echo $file['downloads']; ?></td>
                            <td><a href="videodownload.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
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