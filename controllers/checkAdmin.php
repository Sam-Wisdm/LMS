<?php

if(!isset($_SESSION)){
    session_start();
    $_SESSION['is_admin_login'] = false;
}

include_once('../models/dbconnection.php');

if($_SESSION['is_admin_login'] === false){
    // Login Validation
    $err = [];
    $param = $_POST;

    // Validate form fields
    if (empty($param["AdminLogEmail"])) {
        $err["AdminLogEmail"] = "Email is required.";
    } elseif (!empty($param["AdminLogEmail"]) && !filter_var($param["AdminLogEmail"], FILTER_VALIDATE_EMAIL)) {
        $err["AdminLogEmail"] = "Invalid email address.";
    } 

    if (empty($param["AdminLogPassw"])) {
        $err["AdminLogPassw"] = "Password is required.";
    } 

    if (empty($err)) { // If no validation errors

        $AdminLogEmail = mysqli_real_escape_string($conn, $param["AdminLogEmail"]);
        $adminpassw = mysqli_real_escape_string($conn, $param["AdminLogPassw"]);

        // SQL Query to insert data into database
        $sql = "SELECT * FROM admin WHERE admin_email='" . "$AdminLogEmail" . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if($result->num_rows === 0){
            $err['AdminLogEmail'] = "Invalid email address.";
            echo json_encode(["success" => false, "message" => "Failed to Login.", "errors" => $err]);   
        }
        else if($result->num_rows === 1){
            if(password_verify($adminpassw, $row["admin_pass"])){
                $_SESSION['is_admin_login'] = true;
                $_SESSION['AdminLogEmail'] = $AdminLogEmail;
                echo json_encode(["success" => true, "message" => "Login Successful.", "data" => $row]);
            } else {
                $err['AdminLogPassw'] = "Invalid Password.";
                echo json_encode(["success" => false, "message" => "Failed to Login.", "errors" => $err]);            
            }
        } 

    } else {
        echo json_encode(["success" => false, "errors" => $err, "message" => "Failed to Login."]); // Send errors
    }
}
else{
    echo json_encode(["success" => false, "session_is_login" => $_SESSION['is_login']]);
}

/* ?> */
