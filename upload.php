<?php
include('includes/theader.php');
include('includes/tnavbar.php');
$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['cname']);
    $productInfo = $_POST['cinfo'];
    $productPrice = dataFilter($_POST['price']);
    $tid = $row['id'];
    if (empty($tid)) {
        $sql = "INSERT INTO `fcourses` (`tid`, `product`, `pcat`, `pinfo`, `price`) VALUES ('1', '$productName', '$productType', '$productInfo', '$productPrice');";
    } else $sql = "INSERT INTO `fcourses` (`tid`, `product`, `pcat`, `pinfo`, `price`) VALUES ('$tid', '$productName', '$productType', '$productInfo', '$productPrice');";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        $_SESSION['message'] = "Unable to upload Product !!!";
        header("location: teacher-dashboard.php");
    } else {
        $_SESSION['message'] = "successfull !!!";
    }

    $pic = $_FILES['coursePIC'];
    $picName = $pic['name'];
    $picTmpName = $pic['tmp_name'];
    $picSize = $pic['size'];
    $picError = $pic['error'];
    $picType = $pic['type'];
    $picExt = explode('.', $picName);
    $picActualExt = strtolower(end($picExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($picActualExt, $allowed)) {
        if ($picError === 0) {
            $_SESSION['productPicId'] = $_SESSION['id'];
            $picNameNew = $productName . $_SESSION['productPicId'] . "." . $picActualExt;
            $_SESSION['productPicName'] = $picNameNew;
            $_SESSION['productPicExt'] = $picActualExt;
            $picDestination = "./uploads/" . $picNameNew;
            move_uploaded_file($picTmpName, $picDestination);
            $id = $_SESSION['id'];

            $sql = "UPDATE fcourses SET pimage='$picNameNew' WHERE product='$productName';";

            $result = mysqli_query($db, $sql);
            if ($result) {

                $_SESSION['message'] = "Product Image Uploaded successfully !!!";
                header("location: teacher-dashboard.php");
            } else {
                //die("bad");
                $_SESSION['message'] = "There was an error in uploading your product Image! Please Try again!";
                header("location: teacher-dashboard.php");
            }
        } else {
            $_SESSION['message'] = "There was an error in uploading your product image! Please Try again!";
            header("location: teacher-dashboard.php");
        }
    } else {
        $_SESSION['message'] = "You cannot upload files with this extension!!!";
        header("location: teacher-dashboard.php");
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
        <!-- <form method="POST" action="process.php" enctype="multipart/form-data"> -->
        <form method="POST" action="upload.php" enctype="multipart/form-data">

            <center>
                <h3>...Enter the Course Information here...</h3>
            </center>
            <br>
            <center>
                <input type="file" name="coursePIC"></input>
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
                            <option value="Computer Science">Computer Science</option>
                            <option value="Biology">Biology</option>
                            <option value="Law">Law</option>
                            <option value="Physics">Physics</option>
                            <option value="Economics">Economics</option>
                            <option value="History">History</option>
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
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" value="" placeholder="Price" style="background-color:white;color: black;" />
                </div>
                <div class="12u$">
                    <center>
                        <button type="submit" class="btn btn-outline-primary" name="CourseUpload" style="margin-right: 6px;border-radius: 12px !important;">Submit</button>
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