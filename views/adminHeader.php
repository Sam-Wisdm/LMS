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
        <div class="admindashboard-nav">
            <h1><a href="./adminDashboard.php">Admin Dashboard</a></h1>
        </div>
        <div class="admindashboardcontent-nav">
            <ul>
                <li>
                    <a href="../views/adminCourses.php">Courses</a>
                </li>
                <li>
                    <a href="./adminLesson.php">Lessons</a>
                </li>
                <li>
                    <a href="./adminStudents.php">Students</a>
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