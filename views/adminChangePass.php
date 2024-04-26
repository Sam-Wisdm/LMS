<?php
include('./adminHeader.php');
include('../models/dbconnection.php');

if(!isset($_SESSION)) {
    session_start();
}

if($_SESSION['is_admin_login'] === true) {
    $adminEmail = $_SESSION['AdminLogEmail'];
} else {
    echo "<script>location.href='/';</script>";
}

?>

<div class="adminChangePass" style="margin: auto;">
    <div class="adminChangePass-heading" style="background-color:#dc3545; border-radius: 20px; color: azure; padding: 5px;">
        <h2>Change Admin Password</h2>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label for="newPass">Enter New Password</label> <br>
            <input class="form-control" type="text" id="adminNewPass" name="adminNewPass">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="adminChangePassBtn" name="adminChangePassBtn">
                Submit
            </button> &emsp;
            <a href="./adminDashboard.php" id="changePassClose">Close</a>
        </div>
        <div class="msg">
            <?php if(!empty($msg)) {echo $msg;} ?>
        </div>
    </form>
</div>

<?php
$msg = '';
if(isset($_REQUEST['adminChangePassBtn'])) {
    $adminNewPass = $_REQUEST['adminNewPass'];
    $sql_update_adminPass = "UPDATE 'admin' SET 'admin_pass' = '$adminNewPass' WHERE 'admin'.'admin_id' = 1";
    if($conn->query($sql_update_adminPass)) {
        $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Updated Password.</div>';
    } else {
        $msg = '<div class="alert alert-danger col-sm-6 ml-auto mr-auto mt-5 text-centre">Failed To Update Password.</div>';
    }
} 

include('./adminFooter.php');
?>