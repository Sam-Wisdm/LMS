<?php

include('../models/dbconnection.php');

function checkDB() {
    include('../models/dbconnection.php');
    $sql_db = "SELECT SCHEMA_NAME
            FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = 'LMS';
            ";

    $result_db = $conn->query($sql_db);

    if($result_db->num_rows == 0) {
        $sql_create_db = "CREATE DATABASE LMS";
        if($conn->query($sql_create_db)) {
            echo json_encode(["success" => true, "message" => "DB created"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create DB"]);        
        }
    }
    else {
        $DB_name = 'LMS';

        // Check if the table exists in the database
        $sql_check_tables = "SHOW TABLES FROM $DB_name";
        $result = $conn->query($sql_check_tables);

        if ($result->num_rows == 0) {

            $sql_create_admin = "CREATE TABLE admin (
                admin_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                admin_name varchar(255) NOT NULL,
                admin_email varchar(255) NOT NULL UNIQUE,
                admin_pass varchar(255) NOT NULL
            )";
            $sql_add_admin = "INSERT INTO admin (admin_name, admin_email, admin_pass) VALUES ('admin', 'admin@gmail.com', 'admin')";

            $sql_create_course = "CREATE TABLE course (
                course_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                course_title text NOT NULL,
                course_desc text NOT NULL,
                course_author varchar(255) NOT NULL,
                course_rate float DEFAULT 0,
                course_stud_enroll_cnt int DEFAULT 0,
                course_img text
            )";

            $sql_create_lesson = "CREATE TABLE lesson (
                lesson_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                lesson_name text NOT NULL,
                lesson_desc text NOT NULL,
                lesson_link text NOT NULL,
                course_id int NOT NULL,
                FOREIGN KEY (course_id) REFERENCES course(course_id)
            )";

            $sql_create_student = "CREATE TABLE student (
                stu_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                stu_name varchar(255) NULL,
                stu_email varchar(255) UNIQUE NOT NULL,
                stu_username varchar(255) NOT NULL,
                stu_pass varchar(255) NOT NULL,
                stu_img text NULL
            )";

            if($conn->query($sql_create_admin) && $conn->query($sql_create_course) && $conn->query($sql_create_lesson) && $conn->query($sql_create_student)) {
                // $conn->query($sql_add_admin);
                echo json_encode(["success" => true, "message" => "All tables created"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to create tables"]);
            }

        } else {
            echo json_encode(["success" => true, "message" => "DB and all tables exists"]);
        }

        // Close the database connection
        $conn->close();

    }
}

// checkDB();