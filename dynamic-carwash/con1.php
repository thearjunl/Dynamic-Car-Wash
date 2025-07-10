<?php
session_start();

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'dynamic';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$location = $_POST['location'];
$cpassword = $_POST['cpassword'];

if ($password !== $cpassword) {
    echo "Passwords do not match.";
    exit();
}

$stmt = $conn->prepare("INSERT INTO login (email, password, user_type) VALUES (?, ?, 'User')");
$stmt->bind_param("ss", $email, $password);

if ($stmt->execute()) {
    $loginId = $stmt->insert_id;
    $vregQuery = "INSERT INTO signup (id, name, phone, location) VALUES (?, ?, ?, ?)";
    $vregStmt = $conn->prepare($vregQuery);
    $vregStmt->bind_param("isss", $loginId, $name, $phone, $location);

    if ($vregStmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Error inserting into tbl_vreg: " . $conn->error;
    }

    $vregStmt->close();
} else {
    echo "Error inserting into logins: " . $conn->error;
}

$stmt->close();
$conn->close();
?>