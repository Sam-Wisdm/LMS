<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
$courseArr = [];
if (isset($_SESSION['courseID']) && empty($courseArr)) {
    $sql_course = "SELECT * FROM course WHERE course_id = {$_SESSION['courseID']}";
    $result = $conn->query($sql_course);
    $courseArr = $result->fetch_assoc();
}

if ($conn === null) {
    // Handle database connection error
    $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed to connect to the database.</div>';
} else {
    if (isset($_REQUEST['lessonSubmitBtnClk'])) {
        // var_dump($_REQUEST);
        if (empty($_REQUEST['lessonName']) || empty($_REQUEST['lessonDesc']) || empty($_SESSION['courseID'])) {
            $msg = '<div class="alert alert-warning col-sm-6 ml-auto mr-auto mt-5 text-centre">Fill All Fields.</div>';
        } else {
            $lessonName = mysqli_real_escape_string($conn, $_REQUEST['lessonName']);
            $lessonDesc = mysqli_real_escape_string($conn, $_REQUEST['lessonDesc']);
            $courseID = mysqli_real_escape_string($conn, $_SESSION['courseID']);
            $lessonLink = $_FILES['lessonLink']['name'];    
            $lessonLinkTemp = $_FILES['lessonLink']['tmp_name'];
            $vidFolder = './images/lesson_videos/' . $lessonLink;
            // Handle file upload
            if (move_uploaded_file($lessonLinkTemp, $vidFolder)) {
                $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id) VALUES ('$lessonName', '$lessonDesc', '$vidFolder', '$courseID')";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<div class="alert alert-success col-sm-6 ml-auto mr-auto mt-5 text-centre">lesson added successfully.</div>';
                    // Redirect to another page after successful form submission
                    echo "<script>window.location.href = './addLesson.php?checkid=$courseID';</script>";
                    die();
                } else {
                    $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed to add lesson: ' . $conn->error . '</div>';
                }
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Sorry, there was an error uploading your file.</div>';
            }
        }
    }
}

?>

<div class="addlessonForm-box" style="margin: 50px auto; width: 50%;">
    <div class="addlessonForm-heading">
        <h2>Add lesson</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="courseID">Course ID</label>
            <input disabled type="text" class="form-control-file" id="courseID" name="courseID" value="<?php if(isset($courseArr['course_id'])) {echo $courseArr['course_id'];} ?>">
        </div>
        <div class="form-group">
            <label for="courseName">Course Name</label>
            <input disabled  type="text" class="form-control-file" id="courseName" name="courseName" value="<?php if(isset($courseArr['course_title'])) {echo $courseArr['course_title'];} ?>">
        </div>
        <div class="form-group">
            <label for="lessonName">Lesson Name</label>
            <input type="text" class="form-control" id="lessonName" name="lessonName">
        </div>
        <div class="form-group">
            <label for="lessonDesc">Lesson Description</label>
            <textarea class="form-control" name="lessonDesc" id="lessonDesc" cols="30" rows="10"></textarea>
            <!-- <input type="text" class="form-control" id="lessonDesc" name="lessonDesc"> -->
        </div>
        <div class="form-group">
            <label for="lessonLink">Lesson Link</label>
            <input type="file" class="form-control" id="lessonLink" name="lessonLink">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="lessonSubmitBtnClk" name="lessonSubmitBtnClk" value="true">
                Add
            </button> &emsp;
            <a href="./adminLesson.php" id="lessonClose">Close</a>
        </div>
        <div class="addlessonMsg">
            <?php if(!empty($msg)) {echo $msg;} ?>
        </div>
    </form>
</div>

<?php
// echo "<script>alert($msg);</script>";
// echo json_encode($msg);

include('adminFooter.php');
?>