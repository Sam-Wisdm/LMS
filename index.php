<?php

// echo "hello world!";

require_once './core/Router.php';

// $app = new Application();
$router = new Router();

// $router->get('/', 'home');                  // get(request, response)

// $router->get('/register', 'register');
// $router->post('/register', 'register');

// $router->get('/login', 'login');
// $router->post('/login', 'login');

$router->get('/index.php', function() {
    include './views/home.php'; // Render home.php
});

$router->get('/home.php', function() {
    include './views/home.php'; // Render home.php
});

$router->get('/', function() {
    include './views/home.php'; // Render home.php
});

$router->get('/register', function() {
    include './views/register.php'; // Render register.php
});

$router->post('/register', function() {
    include './views/register.php'; // Render register.php
});

$router->get('/login', function() {
    include './views/login.php'; // Render login.php
});

$router->post('/login', function() {
    include './views/login.php'; // Render login.php
});

$router->get('/course_archive', function() {
    include './views/course_archive.php'; // Render course_archive.php
});

$router->get('/courseContent?cid=', function($params) {
    $cid = $params['cid'];
    include "./views/courseContent.php"; // Render course content based on cid
});

$router->get('/courseNav?cid=', function() {
    include "./views/courseNav.php"; // Render course content based on cid
});

$router->get('/courseNav.php', function() {
    include "./views/courseNav.php"; // Render course content based on cid
});

$router->get('/adminDashboard.php', function() {
    include './views/adminDashboard.php'; // Render adminDashboard.php
});

$router->get('/adminCourses.php', function() {
    include './views/adminCourses.php'; // Render adminCourses.php
});

$router->get('/addCourse.php', function() {
    include './views/addCourse.php'; // Render addCourse.php
});

$router->get('/addLesson.php', function() {
    include './views/addLesson.php'; // Render addLesson.php
});

$router->get('/adminLesson.php', function() {
    include './views/adminLesson.php'; // Render adminLesson.php
});

$router->get('/adminChangePass.php', function() {
    include './views/adminChangePass.php'; // Render adminChangePass.php
});

$router->get('/adminStudents.php', function() {
    include './views/adminStudents.php'; // Render adminStudents.php
});

$router->get('/editCourse.php', function() {
    include './views/editCourse.php'; // Render adminStudents.php
});

$router->resolve($_SERVER['REQUEST_URI']);