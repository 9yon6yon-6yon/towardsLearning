<?php
include('includes/theader.php');
include('includes/tnavbar.php');

$query = mysqli_query($db, "SELECT * FROM teacher where Email='$email'") or die(mysqli_error($db));
$row = mysqli_fetch_array($query);



?>

<section id="one" class="wrapper style1 align-center">
    <div class="container">
        <form method="POST" action="process.php" enctype="multipart/form-data">
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
                            <option value="" ">- Category -</option>
                            <option value=" Bangla">Bangla</option>
                            <option value="English">English</option>
                            <option value="Math">Math</option>
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