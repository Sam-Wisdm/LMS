<?php
include(dirname(__DIR__) . '/views/header.php');
include('./controllers/checkDB.php');
// checkDB();
?>
<div class="banner">
  <!-- <div class="slider" id="slider">
    <div id="slide-arr">
      <button onclick="prev()" class="slide-arr-btn" id="slide-prev-arr">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60" fill="white">
          <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8592;</text>
        </svg>
      </button>
      <button onclick="next()" class="slide-arr-btn" id="slide-next-arr">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60" fill="white">
          <text x="12" y="16" text-anchor="middle" font-size="30" font-weight="bold">&#8594;</text>
        </svg>
      </button>
    </div>
    <div class="slide-content">
      <p id="head"><b> </b></p>
      <P id="desc"> </P>
      <div class="read-btn" onclick="">
        <p style="cursor: pointer;">Explore Course</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
          <text x="12" y="11" text-anchor="middle" font-size="30" font-weight="bold">&#8594;</text>
        </svg>
      </div>
    </div>
  </div> -->

  <div class="banner-cont">
    <h1>Welcome to LMS</h1>
    <p>Learn latest technologies to upgrad your career!</p>

    <!-- Button trigger modal -->
    <?php
      if(isset($_SESSION['is_login'])) {
        echo '
        <a href="/views/course_archive.php">
        <button type="button" class="banner-btn btn btn-primary" onclick="getCourseArr()">
          View Courses
        </button>
        </a>
        ';
      } else {
        echo '
        <button type="button" class="banner-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#StudRegModal">
          Get Started
        </button>
        ';
      }
    ?>
  </div>

<div class="course">

</div>

<!-- Footer Start -->
<?php
include(dirname(__DIR__) . '/views/footer.php');
?>
<!-- Footer End -->