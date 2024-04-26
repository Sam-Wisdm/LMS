<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SERVER['REQUEST_URI'] ?></title>
  <link rel="stylesheet" href="<?php dirname(__DIR__) ?>/views/home.css">
  <link rel="stylesheet" href="<?php dirname(__DIR__) ?>/views/register.css">
  <link rel="stylesheet" href="<?php dirname(__DIR__) ?>/views/login.css">
  <!-- <link rel="stylesheet" href="./views/course_archive.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LMS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>

          <?php
          session_start();
          // var_dump($_SESSION);
          if ($_SESSION['is_login'] === true) {
            echo '
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#">My Profile</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="/views/course_archive.php" onclick="getCourseArr()">Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../controllers/logout.php">Logout</a>
                </li>
                <!--
                <form class="d-flex" role="search">
                  <input id="searchbar" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                -->
              ';
          } else {
            echo '
                <li class="nav-item">
                  <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#StudRegModal">Sign Up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"  data-bs-toggle="modal" data-bs-target="#StudLoginModal">Sign in</a>
                </li>
                <li class="nav-item navbar-nav ml-auto mb-2 mb-lg-0">
                  <a class="nav-link active" aria-current="page" href="./adminlogin.php" data-bs-toggle="modal" data-bs-target="#AdminLoginModal">Admin Login</a>
                </li>
              ';
          }
          ?>

          <!-- <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./controllers/logout.php">Logout</a>
          </li> -->
        </ul>
        <!-- <form class="d-flex" role="search">
          <input id="searchbar" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>