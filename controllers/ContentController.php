<?php

include('../models/dbconnection.php');
$courseArr = [];
$status = false;
$msg = "";
if($_POST['getCourseArrForRendering']) {
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        // $row = $result->fetch_assoc() -> only converts one row to asso arr
        while($row = $result->fetch_assoc()) {
            array_push($courseArr, $row);
        }     
        $status = true;
        $msg = "Course Table Fetched";
    } else {
        $msg = "Unable to fetch Course Table";
    }
    echo json_encode(["success" => $status, "courseArr" => $courseArr, "msg" => $msg]);
}