<?php

include('../models/dbconnection.php');
$courseArr = [];
$courseCnt = 0;
$status = false;
$msg = "";
if($_POST['getCourseArrForRendering']) {
    $pgidx = $_POST['pageNo'];
    $offset = $pgidx * 4;
    $sql = "SELECT * FROM course LIMIT 4 OFFSET $offset";
    $sql_count = "SELECT COUNT(*) as cnt FROM course";
    $result_count = $conn->query($sql_count);
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        // $row = $result->fetch_assoc() -> only converts one row to asso arr
        while($row = $result->fetch_assoc()) {
            array_push($courseArr, $row);
        }     
        $row_count = $result_count->fetch_assoc();
        $courseCnt = $row_count['cnt'];
        $status = true;
        $msg = "Course Table Fetched";
    } else {
        $msg = "Unable to fetch Course Table";
    }
    echo json_encode(["success" => $status, "courseArr" => $courseArr, "courseCnt" => $courseCnt, "msg" => $msg]);
}