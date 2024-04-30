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
<div class="box" style="
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    justify-content: start;
                    align-items: center;">
    <div class="mt-5 mx-3">
        <form action="" class="mt-3 form-inline d-print-none" style="min-height: 100px">
            <div class="form-group mr-3">
                <label for="checkid">Enter Course ID: </label>
                <input type="text" class="form-control ml-3" id="checkid" name="checkid"> &emsp;
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_REQUEST['checkid'])) {
        $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid']}";
        $result = $conn->query($sql);
        $row_course = $result->fetch_assoc();
        // isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row_course['course_id']
        if (count($row_course)) {

    ?>

        <div class="lesson-table-box" style="width: 80%;">
            <h3>Course ID - <?php if (isset($row_course['course_id'])) {
                                echo $row_course['course_id'];
                            } ?> : <?php if (isset($row_course['course_title'])) {
                                echo $row_course['course_title'];
                            } ?> </h3>
            <table class="lesson-table" style="text-align: center; width: 80%;">
                <thead>
                    <th>Lesson ID</th>
                    <th>Lesson Name</th>
                    <th>Lesson Description</th>
                    <th>Lesson Link</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $cid = $row_course['course_id'];
                    $sql_retrive_less = "SELECT * FROM lesson WHERE course_id = $cid";
                    $result_less = $conn->query($sql_retrive_less);
                    $less_arr = [];
                    if ($result_less->num_rows > 0) {/* $less_arr = $result_less->fetch_assoc(); */
                        while ($less_arr = $result_less->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>{$less_arr['lesson_id']}</td>
                                    <td>{$less_arr['lesson_name']}</td>
                                    <td>{$less_arr['lesson_desc']}</td>
                                    <td>{$less_arr['lesson_link']}</td>
                                    <!-- <td>{$less_arr['course_id']}</td> -->
                                    <td class='inline d-flex' style='display:flex; justify-content: space-around; align-items: center;'>
                                        <!-- Edit Button -->
                                        <form action='./editLesson.php' method='POST'>
                                            <input type='hidden' name='lesson_id' value='" . $less_arr['lesson_id'] . "'>
                                            <button type='submit' name='edit' class='btn btn-primary'>Edit</button>
                                        </form>
                                        
                                        <!-- Delete Button -->
                                        <form action='' method='POST' onsubmit='return confirm('Are you sure you want to delete this course?');'>
                                            <input type='hidden' name='lesson_id' value='" . $less_arr['lesson_id'] . "'>
                                            <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "<tr> <td> no Data. </td> </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a class="addLesson-btn-a" href="./addLesson.php">
                        <?php $_SESSION['courseID'] = $row_course['course_id'] ?>
                        <div id="addLesson" name="addLesson" style="width: 50px; height: 50px; border-radius: 10px; display: flex; justify-content: center; 
                                                                    align-items: center; background-color: #dc3545; border: 1px solid #dc3545; color: azure; 
                                                                    font-size: 30px; font-weight: bolder; position: fixed; bottom: 50px; right: 50px;">
                         + 
                        </div>
            </a>
        </div>

    <?php
        }
    } else {
        // echo "Enter course id.";
    }
    // }
    // }
    ?>

</div>

<?php

if(isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['lesson_id']}";
    if($conn->query($sql) == TRUE) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        echo "Unable to delete data.";
        echo "<script>console.log('Unable to delete data.')</script>";
    }
} 

include('adminFooter.php');
?>