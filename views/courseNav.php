<?php
include('./header.php');
include('../models/dbconnection.php');

// session
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['is_login']) {
    $current_url = "$_SERVER[REQUEST_URI]";
    $cid;
    for ($i = strlen($current_url) - 1; $i > 0; $i--) {
        if ($current_url[$i] == '=') {
            $cid = substr($current_url, $i + 1, strlen($current_url));
            break;
        }
    }
    $cid = intval($cid);
    $less_arr = [];     // lesson array
    if (isset($cid)) {
        $_SESSION['course_id'] = $cid;
        $sql = "SELECT * FROM lesson WHERE course_id = $cid";
        $result = $conn->query($sql);
        // fetch->assoc() fetches row wise array -> 
        // array(2) { [0]=> array(6) { ["lesson_id"]=> string(1) "1" ["lesson_name"]=> string(17) "name" ["lesson_desc"]=> string(22) "desc" ["lesson_link"]=> string(44) "link" ["course_id"]=> string(2) "21" ["course_name"]=> string(26) "course_name" } 
        // [1]=> array(6) { ["lesson_id"]=> string(1) "1" ["lesson_name"]=> string(17) "name" ["lesson_desc"]=> string(22) "desc" ["lesson_link"]=> string(44) "link" ["course_id"]=> string(2) "21" ["course_name"]=> string(26) "course_name" }
        while ($table = $result->fetch_assoc()) {
            array_push($less_arr, $table);
        }
        $cname = $less_arr[0]['course_name'];
        $sql_c = "SELECT * FROM course WHERE course_id = $cid";
        $result_c = $conn->query($sql_c);
        $row = $result_c->fetch_assoc();
        $author = $row['course_author'];
    }

    // if(isset($less_arr)) {
    //     $_SESSION['lesson_id'] = $less_arr['lesson_id'];
    // }

?>
    <link rel="stylesheet" href="./courseNav.css">
    <div class="courseNav-box">
        <div class="courseNavBar" id="courseNavBar">
            <?php
            
            $less_arr_json = json_encode($less_arr);
            $row_json = json_encode($row);
            echo "<script>var lessonArr = " . $less_arr_json . ";</script>";
            echo "<script>var courseRow = " . $row_json . ";</script>";

            ?>
        </div>
        <div class="courseNavContent">
            <div id="courseNav-vid">

            </div>
            <div id="courseNav-overview">

            </div>
        </div>
    </div>

    <script src="./courseNav.js"></script>
<?php
} else {
    echo "<script>location.href='/';</script>";
}
// include('./footer.php');
?>