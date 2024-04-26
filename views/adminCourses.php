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

<div class="course-table">
    <table class="course-table-table" id="course-table-table">
        <div class="course-table-heading">
            Course Details Overview
        </div>
        <thead>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Author</th>
            <!-- <th>Rate</th>
            <th>Total Students Enrolled</th> -->
            <th>Action</th>
        </thead>
        <tbody class="course-table-content" id="course-table-content">
            <?php 
                $sql = "SELECT * FROM course";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($courseTable = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>" . $courseTable['course_id'] . "</td>
                                <td>" . $courseTable['course_title'] . "</td>
                                <td>" . $courseTable['course_author'] . "</td>
                                <!-- <td>" . $courseTable['course_rate'] . "</td>
                                <td>" . $courseTable['course_stud_enroll_cnt'] . "</td> -->
                                <td class='inline d-flex' style='display:flex; justify-content: space-around; align-items: center;'>
                                    <!-- Edit Button -->
                                    <form action='editCourse.php' method='POST'>
                                        <input type='hidden' name='course_id' value='" . $courseTable['course_id'] . "'>
                                        <button type='submit' name='edit' class='btn btn-primary'>Edit</button>
                                    </form>
                                    
                                    <!-- Delete Button -->
                                    <form action='' method='POST' onsubmit='return confirm('Are you sure you want to delete this course?');'>
                                        <input type='hidden' name='course_id' value='" . $courseTable['course_id'] . "'>
                                        <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No courses found</td></tr>";
                }

            ?>
        </tbody>
    </table>

    <a class="addCourse-btn-a" href="./addCourse.php">
        <div class="addCourse-btn btn btn-danger">
            +
        </div>
    </a>
</div>

<?php

if(isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['course_id']}";
    if($conn->query($sql) == TRUE) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        echo "Unable to delete data.";
        echo "<script>console.log('Unable to delete data.')</script>";
    }
} 

include('./adminFooter.php');
?>
