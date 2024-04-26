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

// $sql_retrieve_stud = "SELECT * FROM student";
// $result = $conn->query($sql_retrieve_stud);
// if($result->num_rows > 0) {
//     $stud_arr = $result->fetch_assoc();
// } else {
//     echo "No data.";
// }

?>

<div class="studDetail-box" style="width: 100%; display: flex; flex-direction:column; justify-content: center; align-items: center;">
    <table class="stud-table-table" id="stud-table-table" style="width: 80%; text-align: center;">
        <div class="stud-table-heading">
            <h3>Student Details Overview</h3>
        </div>
        <thead>
            <th>Student ID</th>
            <!-- <th>Student Name</th> -->
            <th>Student Email</th>
            <th>Student User Name</th>
            <!-- <th>Student Password</th>
            <th>Student Image</th> -->
        </thead>
        <tbody class="stud-table-content" id="stud-table-content">
            <?php 
                $sql = "SELECT * FROM student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($stud_arr = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>" . $stud_arr['stu_id'] . "</td>
                                <!-- <td>" . $stud_arr['stu_name'] . "</td>  -->
                                <td>" . $stud_arr['stu_email'] . "</td>
                                <td>" . $stud_arr['stu_username'] . "</td>
                                <!-- <td>" . $stud_arr['stu_pass'] . "</td>
                                <td>" . $stud_arr['stu_img'] . "</td> -->

                            </tr> <br>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }

            ?>
        </tbody>
    </table>
</div>

<?php
include('adminFooter.php');
?>