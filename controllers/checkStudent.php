<?php



if (!isset($_SESSION)) {
    session_start();
    $_SESSION['is_login'] = false;
}

include_once('../models/dbconnection.php');

if ($_SESSION['is_login'] === false) {
    // Login Validation
    $err = [];
    $param = $_POST;

    // Validate form fields
    if (empty($param["stuLogEmail"])) {
        $err["stuLogEmail"] = "Email is required.";
    } elseif (!empty($param["stuLogEmail"]) && !filter_var($param["stuLogEmail"], FILTER_VALIDATE_EMAIL)) {
        $err["stuLogEmail"] = "Invalid email address.";
    }

    if (empty($param["stuLogPassw"])) {
        $err["stuLogPassw"] = "Password is required.";
    }

    if (empty($err)) { // If no validation errors

        $stuemail = mysqli_real_escape_string($conn, $param["stuLogEmail"]);
        $passw = mysqli_real_escape_string($conn, $param["stuLogPassw"]);

        // SQL Query to insert data into database
        $sql = "SELECT stu_email, stu_pass FROM student WHERE stu_email = '$stuemail'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows === 0) {
            $err['stuLogEmail'] = "Invalid email address.";
            echo json_encode(["success" => false, "message" => "Failed to Login.", "errors" => $err]);
        } else if ($result->num_rows === 1) {
            // $passw === $row['stu_pass']
            if (password_verify($passw, $row["stu_pass"])) {
                $_SESSION['is_login'] = true;
                $_SESSION['stuLogEmail'] = $stuemail;
                echo json_encode(["success" => true, "message" => "Login Successful."]);
                // // Redirect to the specified URL
                // header("Location: http://localhost:8081/views/home.php");
                // die(); // Terminates script execution

            } else {
                $err['stuLogPassw'] = "Invalid Password.";
                echo json_encode(["success" => false, "message" => "Failed to Login.", "errors" => $err]);
            }
        }
    } else {
        echo json_encode(["success" => false, "errors" => $err, "message" => "Failed to Login."]); // Send errors
    }
} else {
    echo json_encode(["success" => false, "session_is_login" => $_SESSION['is_login'], "errors" => $err]);
}
die();
