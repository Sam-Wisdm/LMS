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
$lessonRow = [];
if (isset($_REQUEST['lesson_id'])) {
    $sql_retrieve = "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['lesson_id']}";
    $result = $conn->query($sql_retrieve);
    $lessonRow = $result->fetch_assoc();
}

if (isset($_POST['lessonEditBtn'])) {
    $lessonName = mysqli_real_escape_string($conn, $_POST['lessonName']);
    $lessonDesc = mysqli_real_escape_string($conn, $_POST['lessonDesc']);
    $lid = mysqli_real_escape_string($conn, $_POST['lessonID']);
    $lessonVid = mysqli_real_escape_string($conn, $_POST['vidOldPath']);
    // Check if file was uploaded successfully
    if (empty($lessonName) || empty($lessonDesc)) {
        $msg =  '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Fill All Fields.</div>';
    } else {
        if (isset($_FILES['lessonVid']['name']) && strlen($_FILES['lessonVid']['name']) > 0) {
            $lessonVid = "./images/lesson_videos" . $_FILES['lessonVid']['name'];
            move_uploaded_file($_FILES['lessonVid']['tmp_name'], $lessonVid);
        } 
        $sql_update = "UPDATE lesson
                   SET lesson_name = '$lessonName', lesson_desc = '$lessonDesc', lesson_link = '$lessonVid'
                   WHERE lesson_id = '$lid'";
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
    $redirectURL = "http://$_SERVER[HTTP_HOST]/views/adminLesson.php";
    
    // Redirect to the constructed URL
    header("Location: $redirectURL");
    exit;
}

?>

<div class="editlessonForm-box" style="margin: auto; width: 50%;">
    <div class="editlessonForm-heading">
        <h2>Edit Lesson Details</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="lessonID">Lesson ID : </label> <?php if (isset($lessonRow['lesson_id'])) {
                                                            echo $lessonRow['lesson_id'];
                                                        } ?>
            <input hidden type="number" class="form-control" id="lessonID" name="lessonID" value="<?php if (isset($lessonRow['lesson_id'])) {
                                                                                                        echo htmlspecialchars($lessonRow['lesson_id']);
                                                                                                    } ?>">
        </div>
        <div class="form-group">
            <label for="lessonName">Lesson Name</label>
            <input type="text" class="form-control" id="lessonName" name="lessonName" value="<?php if (isset($lessonRow['lesson_name'])) {
                                                                                                    echo htmlspecialchars($lessonRow['lesson_name']);
                                                                                                } ?>">
        </div>
        <div class="form-group">
            <label for="lessonDesc">Lesson Description</label>
            <textarea class="form-control" name="lessonDesc" id="lessonDesc" cols="30" rows="5"><?php if (isset($lessonRow['lesson_desc'])) {
                                                                                                    echo htmlspecialchars($lessonRow['lesson_desc']);
                                                                                                } ?></textarea>
        </div>
        <div class="form-group">
            <label for="lessonVid">Lesson Video</label> <br>
            <input type="file" class="form-control-file" id="lessonVid" name="lessonVid">
            <input hidden type="text" name="vidOldPath" id="vidOldPath" value="<?php if(isset($lessonRow['lesson_link'])) {echo htmlspecialchars($lessonRow['lesson_link']);} ?>">
            <p><?php if (isset($lessonRow['lesson_link'])) {echo htmlspecialchars($lessonRow['lesson_link']); } ?></p>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="lessonEditBtn" name="lessonEditBtn">
                Update
            </button> &emsp;
            <a href="./adminLesson.php" id="lessonClose">Close</a>
        </div>
        <div class="editlessonMsg">
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