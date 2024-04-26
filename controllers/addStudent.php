<?php
include_once('../models/dbconnection.php');

// Registration Validation
$err = [];
$param = $_POST;

// Validate form fields
if (empty($param["stuemail"])) {
    $err["stuemail"] = "Email is required.";
} elseif (!empty($param["stuemail"]) && !filter_var($param["stuemail"], FILTER_VALIDATE_EMAIL)) {
    $err["stuemail"] = "Invalid email address.";
} else {
    // Check if email already exists in the database
    $stuemail = mysqli_real_escape_string($conn, $param["stuemail"]);
    $check_email_query = "SELECT COUNT(*) as count FROM student WHERE stu_email = '$stuemail'";
    $result = $conn->query($check_email_query);         // runs query and returns result
    $row = $result->fetch_assoc();                      // stores fetched result as an assosiative array; key - cloumn name and value - column value
    if ($row['count'] > 0) {
        $err['stuemail'] = "Email already exists. Try Sign in.";
    }
}

if (empty($param["stuuname"])) {
    $err["stuuname"] = "Username is required.";
}

if (empty($param["stupass"])) {
    $err["stupass"] = "Password is required.";
} elseif (!empty($param["stupass"]) && strlen($param["stupass"]) < 5) {
    $err["stupass"] = "Password must contain minimum 5 characters.";
}

if (empty($param["stuconpass"])) {
    $err["stuconpass"] = "Confirm Password is required.";
} elseif ($param["stuconpass"] !== $param["stupass"]) {
    $err["stuconpass"] = "Confirm Password must be same as Password.";
}

if (empty($err)) { // If no validation errors

    $stuemail = mysqli_real_escape_string($conn, $param["stuemail"]);
    $stuuname = mysqli_real_escape_string($conn, $param["stuuname"]);
    $passw = mysqli_real_escape_string($conn, $param["stupass"]);
    // create new user 
    $options = [
        'cost' => 10,
    ];
    // hashing the password 
    $hashed_password = password_hash($passw, PASSWORD_BCRYPT, $options);

    // // Secure password hashing using PHP's password_hash function
    // $password_hash = password_hash($passw , PASSWORD_DEFAULT);
    // $password_hash = $hashed_password;

    // SQL Query to insert data into database
    $sql = "INSERT INTO student (stu_email, stu_username, stu_pass)
                    VALUES ('$stuemail', '$stuuname', '$hashed_password')";
    if ($conn->query($sql) == TRUE) {
        echo json_encode(["success" => true, "message" => "Data saved to DB successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save data to DB."]);
    }

} else {
    echo json_encode(["success" => false, "errors" => $err, "message" => "Failed to save data to DB."]); // Send errors
}
?>
