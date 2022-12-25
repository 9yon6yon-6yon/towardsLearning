<?php
include('includes/theader.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);
$sql = "SELECT * FROM files";
$result = mysqli_query($db, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Uploads files
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['cname']);
    $productInfo = $_POST['cinfo'];
    $tid = $row['id'];
    $filename = $_FILES['course']['name'];
    $destination = './uploads/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['course']['tmp_name'];
    $size = $_FILES['course']['size'];
    if (!in_array($extension, ['zip', 'pdf', 'docx', 'png', 'jpg', 'jpeg'])) {
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `files` (`tid`, `product`, `pcat`, `pinfo`, `name`, `size`, `type` , `downloads`) VALUES ('$tid', '$productName', '$productType', '$productInfo', '$filename', $size, '$extension' ,0)";
            if (mysqli_query($db, $sql)) {
                header("location: teacher-dashboard.php");
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
function dataFilter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<section id="one" class="wrapper style1 align-center">
    <div class="container">
        <form method="POST" action="videoUpload.php" enctype="multipart/form-data">

            <center>
                <h3>...Enter the Video Information here...</h3>
            </center>
            <br>
            <center>
                <input type="file" name="course"></input>
                <br />
            </center>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="select-wrapper" style="width: auto">
                        <select name="type" id="type" required>
                            <option value="">- Category -</option>
                            <option value="Finance">Finance</option>
                            <option value="English">English</option>
                            <option value="Math">Math</option>
                            <option value="CSE">CSE</option>
                            <option value="Biology">Biology</option>
                            <option value="Law">Law</option>
                            <option value="Chemistry">Chemistry</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="cname" id="cname" value="" placeholder="Course Name" style="background-color:white;color: black;" />
                </div>
            </div>
            <br>
            <div class="12u$">
                <textarea name="cinfo" id="cinfo" rows="12" cols="80"></textarea>
            </div>
            <br>
            <div class="row">
                <div class=" 12u$">
                    <center>
                        <button type="submit" class="btn btn-outline-primary" name="UploadVideo" style="margin-right: 6px;border-radius: 12px !important;">Upload</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</section>


<?php
include('includes/modal.php');
include('includes/footer.php');
?>