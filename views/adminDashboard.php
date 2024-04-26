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

?>

<div class="admindashboardcontent">
    <div class="course-stud-overview">
        <div class="overview-card" id="course-overview">
            <div class="overviewcard-title">
                Courses
            </div>
            <div class="overview-desc" id="course-overview-desc">
                <?php
                    $sql = "SELECT COUNT(*) as total_courses FROM course";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['total_courses'];
                    } else {
                        echo "No courses avalible";
                    }
                ?>
            </div>
            <div class="overview-link">
                <a href="./adminCourses.php">View</a>
            </div>
        </div>
        <div class="overview-card" id="stud-overview">
            <div class="overviewcard-title">
                Students
            </div>
            <div class="overview-desc" id="stud-overview-desc">
                <?php
                    $sql = "SELECT COUNT(*) as total_stud FROM student";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['total_stud'];
                    } else {
                        echo "No courses avalible";
                    }
                ?>
            </div>
            <div class="overview-link">
                <a href="./adminStudents.php">View</a>
            </div>
        </div>
    </div>
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
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No courses found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('adminFooter.php');
?>