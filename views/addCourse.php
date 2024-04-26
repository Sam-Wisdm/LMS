<?php
include('adminHeader.php');
include('../models/dbconnection.php');

if(!isset($_SESSION)) {
    session_start();
}

if($_SESSION['is_admin_login'] === true) {
    $adminEmail = $_SESSION['AdminLogEmail'];
} else {
    echo "<script>location.href='/';</script>";
}

$msg = '';

if ($conn === null) {
    // Handle database connection error
    $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed to connect to the database.</div>';
} else {
    if (isset($_REQUEST['courseSubmitBtn'])) {
        if (empty($_REQUEST['courseName']) || empty($_REQUEST['courseDesc']) || empty($_REQUEST['courseAuthor']) || empty($_FILES['courseImg']['name'])) {
            $msg = '<div class="alert alert-warning col-sm-6 ml-auto mr-auto mt-5 text-centre">Fill All Fields.</div>';
        } else {
            $courseName = mysqli_real_escape_string($conn, $_REQUEST['courseName']);
            $courseDesc = mysqli_real_escape_string($conn, $_REQUEST['courseDesc']);
            $courseAuthor = mysqli_real_escape_string($conn, $_REQUEST['courseAuthor']);
            $courseImg = $_FILES['courseImg']['name'];
            $courseImgTemp = $_FILES['courseImg']['tmp_name'];
            $imgFolder = './images/' . $courseImg;
            // Handle file upload
            if (move_uploaded_file($courseImgTemp, $imgFolder)) {
                $sql = "INSERT INTO course (course_title, course_desc, course_author, course_img) VALUES ('$courseName', '$courseDesc', '$courseAuthor', '$imgFolder')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success col-sm-6 ml-auto mr-auto mt-5 text-centre">Course Added Successfully.</div>';
                } else {
                    $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed to add course: ' . $conn->error . '</div>';
                }
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Sorry, there was an error uploading your file.</div>';
            }
        }
    }
    // echo$msg;
}

?>

<div class="addCourseForm-box">
    <div class="addCourseForm-heading">
        <h2>Add Course</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="courseName">Course Name</label>
            <input type="text" class="form-control" id="courseName" name="courseName">
        </div>
        <div class="form-group">
            <label for="courseDesc">Course Description</label>
            <input type="text" class="form-control" id="courseDesc" name="courseDesc">
        </div>
        <div class="form-group">
            <label for="courseAuthor">Course Author</label>
            <input type="text" class="form-control" id="courseAuthor" name="courseAuthor">
        </div>
        <div class="form-group">
            <label for="courseImg">Course Image</label>
            <input type="file" class="form-control-file" id="courseImg" name="courseImg">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">
                Add
            </button> &emsp;
            <a href="./adminCourses.php" id="courseClose">Close</a>
        </div>
        <div class="addCourseMsg">
            <?php if(!empty($msg)) {echo $msg;} ?>
        </div>
    </form>
</div>

<?php
include('adminFooter.php');
?>