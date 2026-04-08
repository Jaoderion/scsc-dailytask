<?php
// signup_process.php

// Database connection
$servername = "localhost";
$username = "root";      // change if needed
$password = "";          // change if needed
$dbname = "krc_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data safely
$full_name           = $_POST['full_name'];
$user_name           = $_POST['username'];
$user_password       = $_POST['password'];

$staff_name          = $_POST['staff_name'];
$staff_position      = $_POST['staff_position'];

$head_name           = $_POST['head_name'];
$head_title          = $_POST['head_title'];

$administrative_name = $_POST['administrative_name'];
$administrative_title= $_POST['administrative_title'];
$department          = $_POST['department'];

// Hash the password for security
$hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO users 
    (employee_name, username, password, staff_name, staff_position, head_name, head_title, administrative_name, administrative_title, department) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind all 10 parameters
$stmt->bind_param("ssssssssss", 
    $full_name, 
    $user_name, 
    $hashed_password, 
    $staff_name, 
    $staff_position, 
    $head_name, 
    $head_title, 
    $administrative_name, 
    $administrative_title,
    $department
);

// Execute and check
if ($stmt->execute()) {
    // Redirect back to login page after success
    header("Location: login.php?success=1");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
