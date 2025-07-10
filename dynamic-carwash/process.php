<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "dynamic";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle create staff form submission
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    // SQL query to insert new staff
    $sql = "INSERT INTO staff (name, position, salary) VALUES ('$name', '$position', '$salary')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New staff created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle delete staff form submission
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // SQL query to delete staff
    $sql = "DELETE FROM staff WHERE id='$delete_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Staff deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
