<?php
    include('header.php');

    if(!isset($_SESSION)) {
        session_start();
    }
    if($_SESSION['is_login']) {
    
?>
<link rel="stylesheet" href="./home.css">
<link rel="stylesheet" href="./course_archive.css">

<div id="course-arch-container">
    <div class="course-arch-cards" id="course-arch-cards">

    </div>
    <div class="pagination" id="pagination">

    </div>
</div>

<script src="./courseArch.js"></script>
<?php
    } else {
        echo "<script>location.href='/';</script>";
    }
    include('footer.php');
?>