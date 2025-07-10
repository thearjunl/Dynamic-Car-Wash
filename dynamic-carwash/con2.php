<?php
session_start(); 
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'dynamic';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if (isset($_POST['submit'])) {
    $email= $_POST['email'];
    $_SESSION['email']=$email;
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM login WHERE  email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
       if ($user['user_type'] === 'User') {
            $_SESSION['user_type'] = 'User';
            header("Location:about.html");
        }
        exit;
    } else {
        $message = "Authentication failed. Please try again.";
    }
    $conn->close();
}
?>