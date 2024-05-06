<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="adminCourses.css">
    <link rel="stylesheet" href="addCourse.css">
</head>
<body>
    <nav class="admin-nav">
        <div class="admindashboardcontent-nav">
            <ul>
                <li>
                    <a href="./adminDashboard.php" <?php if(preg_match_all('/adminDashboard.php/', $_SERVER['REQUEST_URI'])) {echo 'class="myactive"';} ?>>Admin Dashboard</a>
                </li>
                <li>
                    <a href="../views/adminCourses.php" <?php if(preg_match_all('/adminCourses.php/', $_SERVER['REQUEST_URI'])) {echo 'class="myactive"';} ?>>Courses</a>
                </li>
                <li>
                    <a href="./adminLesson.php" <?php if(preg_match_all('/adminLesson.php/', $_SERVER['REQUEST_URI'])) {echo 'class="myactive"';} ?>>Lessons</a>
                </li>
                <li>
                    <a href="./adminStudents.php" <?php if(preg_match_all('/adminStudents.php/', $_SERVER['REQUEST_URI'])) {echo 'class="myactive"';} ?>>Students</a>
                </li>
                <!-- <li>
                    <a href="../views/adminChangePass.php">Change Password</a>
                </li> -->
                <li>
                    <a href="../controllers/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>