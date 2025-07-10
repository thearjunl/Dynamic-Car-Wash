<?php
session_start();
 $email=$_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .container header {
            font-size: 1.8rem;
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form {
            margin-top: 20px;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box label {
            color: #333;
            font-size: 1rem;
            font-weight: bold;
        }

        .input-box input {
            height: 50px;
            width: 90%;
            outline: none;
            font-size: 1rem;
            color: #333;
            margin-top: 8px;
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 0 15px;
            transition: border-color 0.3s ease;
        }

        .input-box input:focus {
            border-color: #007bff;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form button {
            height: 55px;
            width: 100%;
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 30px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #007bff;
        }

        .form button:hover {
            background: #0056b3;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            font-size: 1rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-btn:hover {
            color: #007bff;
        }
    </style>
        <script src="sweetalert.js"></script>

</head>
<body>
    <div class="container">
        <header>OTP Verification</header>
        <form class="form" action="verification_form.php" method="post">
            <div class="input-box">
                <label for="verification_code">Enter Verification Code:</label>
                <input type="text" name="verification_code" required>
            </div>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>



<?php
require 'db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredCode = $_POST['verification_code'];

    // Compare the entered code with the one stored in the session
    if ($enteredCode == $_SESSION['verification_code']) {
        // Verification successful, proceed with user registration or other actions

        // Update vstatus to 1 in the database
        $updateQuery = "UPDATE login SET status = 1 WHERE email = '$email'";
        $updateResult = $conn->query($updateQuery);
        if ($updateResult) {
        //Registration successful
            echo '<script>
         window.onload=function(){
             swal("Success","Registration Successfull","success").then(function() {
                 window.location = "login.php";
             });
        }
         </script>';
        } else {
            echo "Error updating vstatus: " . $conn->error;
        }
    } else {
        // Verification failed
        echo '<p style="color: red; margin-top: 10px;">Verification failed. Please try again.</p>';
    }
}
?>

