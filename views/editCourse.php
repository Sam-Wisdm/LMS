<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('./adminHeader.php');
include('../models/dbconnection.php');

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['is_admin_login'] === true) {
    $adminEmail = $_SESSION['AdminLogEmail'];
} else {
    echo "<script>location.href='/';</script>";
}

$msg = '';
$courseRow = [];
if (isset($_REQUEST['course_id'])) {
    $sql_retrieve = "SELECT * FROM course WHERE course_id = {$_REQUEST['course_id']}";
    $result = $conn->query($sql_retrieve);
    $courseRow = $result->fetch_assoc();
}

if (isset($_POST['courseEditBtn'])) {
    $courseName = mysqli_real_escape_string($conn, $_POST['courseName']);
    $courseDesc = mysqli_real_escape_string($conn, $_POST['courseDesc']);
    $courseAuthor = mysqli_real_escape_string($conn, $_POST['courseAuthor']);
    $cid = mysqli_real_escape_string($conn, $_POST['courseID']);
    $courseImg = mysqli_real_escape_string($conn, $_POST['courseImgOldPath']);
    // Check if file was uploaded successfully
    if (empty($courseName) || empty($courseDesc) || empty($courseAuthor)) {
        $msg =  '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Fill All Fields.</div>';
    } else {
        if (isset($_FILES['courseImg']['name']) && strlen($_FILES['courseImg']['name']) > 0) {
            $courseImg = "./images/" . $_FILES['courseImg']['name'];
            move_uploaded_file($_FILES['courseImg']['tmp_name'], $courseImg);
        }
        $sql_update = "UPDATE course
                    SET course_title = '$courseName', course_desc = '$courseDesc', course_author = '$courseAuthor', course_img = '$courseImg'
                    WHERE course_id = '$cid'";
        if ($conn->query($sql_update) === TRUE) {
            $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Data Updated Successfully.</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed to update data.</div>';
        }
    }

    // Get the current page URL
    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // Extract the port number from the current URL
    $urlComponents = parse_url($currentURL);
    $port = isset($urlComponents['port']) ? ':' . $urlComponents['port'] : '';

    // Construct the new URL with the same hostname and port number
    $redirectURL = "http://$_SERVER[HTTP_HOST]/views/adminCourses.php";
    
    // Redirect to the constructed URL
    header("Location: $redirectURL");
    exit;
}

?>

<div class="editCourseForm-box" style="margin: auto; width: 50%;">
    <div class="editCourseForm-heading">
        <h2>Edit Course Details</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="courseID">Course ID : </label> <?php if (isset($courseRow['course_id'])) {
                                                            echo $courseRow['course_id'];
                                                        } ?>
            <input hidden type="number" class="form-control" id="courseID" name="courseID" value="<?php if (isset($courseRow['course_id'])) {
                                                                                                        echo htmlspecialchars($courseRow['course_id']);
                                                                                                    } ?>">
        </div>
        <div class="form-group">
            <label for="courseName">Course Name</label>
            <input type="text" class="form-control" id="courseName" name="courseName" value="<?php if (isset($courseRow['course_title'])) {
                                                                                                    echo htmlspecialchars($courseRow['course_title']);
                                                                                                } ?>">
        </div>
        <div class="form-group">
            <label for="courseDesc">Course Description</label>
            <textarea class="form-control" name="courseDesc" id="courseDesc" cols="30" rows="5"><?php if (isset($courseRow['course_desc'])) {
                                                                                                    echo htmlspecialchars($courseRow['course_desc']);
                                                                                                } ?></textarea>
        </div>
        <div class="form-group">
            <label for="courseAuthor">Course Author</label>
            <input type="text" class="form-control" id="courseAuthor" name="courseAuthor" value="<?php if (isset($courseRow['course_author'])) {
                                                                                                        echo htmlspecialchars($courseRow['course_author']);
                                                                                                    } ?>">
        </div>
        <div class="form-group">
            <label for="courseImg">Course Image</label> <br>
            <img src="<?php if (isset($courseRow['course_img'])) {
                            echo $courseRow['course_img'];
                        } ?>" alt="course_img" class="img-thumbnail" height="500px" width="300px">
            <input type="file" class="form-control-file" id="courseImg" name="courseImg">
            <input hidden type="text" name="courseImgOldPath" id="courseImgOldPath" value="<?php if(isset($courseRow['course_img'])) {echo htmlspecialchars($courseRow['course_img']);} ?>">
            <p><?php if(isset($courseRow['course_img'])) {echo htmlspecialchars($courseRow['course_img']);} ?></p>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseEditBtn" name="courseEditBtn">
                Update
            </button> &emsp;
            <a href="./adminCourses.php" id="courseClose">Close</a>
        </div>
        <div class="editCourseMsg">
            <?php if (!empty($msg)) {
                echo $msg;
            }
            ?>
        </div>
    </form>
</div>

<?php

include('./adminFooter.php');
?>