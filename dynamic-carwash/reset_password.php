<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgot_password.php");
    exit(); // Add exit() after header redirects to stop further execution
}

$email = $_SESSION['forgot_password_email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "dynamic";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['password']) && isset($_POST['confirmpassword'])) { // Corrected field names
        $newpassword = $_POST['password']; // Corrected field name
        $confirmpassword = $_POST['confirmpassword']; // Corrected field name
        if ($newpassword == $confirmpassword) {
            // Prepare SQL statement with a parameterized query to prevent SQL injection
            $sql = "UPDATE login SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $newpassword, $email);
            $stmt->execute();
            $stmt->close();

            $_SESSION['success'] = "Password changed successfully";
            header("Location: ./login.php");
            exit(); // Add exit() after header redirects to stop further execution
        } else {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: forgot_password.php");
            exit(); // Add exit() after header redirects to stop further execution
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dynamic Car wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="./sweetalert.js"></script>
    <style>
    .error-message {
        color: red
    }
    </style>
</head>


<style>
#errorMessage {
    color: red;
    margin-top: 5px;
}
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- forgot password section starts here -->
        <!-- HTML code for index page -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="text-decoration-none">
                                <h3 class="text-primary">Car Wash</h3>
                            </a>
                            <h5>Reset Password</h5>
                        </div>
                        <form action="#" method="post" onsubmit="return validateForm()">
                            <!-- Added onsubmit attribute -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="newPassword"
                                    placeholder="newpassword" oninput="validatePassword()">
                                <label for="newPassword">Enter new password</label>
                                <!-- Error message for new password -->
                                <div id="password-error" class="error-message"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="confirmpassword" id="confirmPassword"
                                    placeholder="confirmpassword" oninput="validateConfirmPassword()">
                                <label for="confirmPassword">Confirm new password</label>
                                <!-- Error message for confirm password -->
                                <div id="confirm-password-error" class="error-message"></div>
                            </div>

                            <!-- Countdown timer -->
                            <div id="countdown" style="color: #007bff;"></div>

                            <!-- Error message div -->
                            <div id="errorMessage"></div>

                            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit
                                </button>
                        </form>
                        <a href="./login.php" class="btn btn-outline-primary">&#8249; Back</a>

                        <!-- Back button -->
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            function showError(input, message, errorId) {
                document.getElementById(errorId).textContent = message;
            }

            function showSuccess(errorId) {
                document.getElementById(errorId).textContent = '';
            }

            function validateField(input, regex, message, errorId) {
                const value = input.value.trim();
                const isValid = regex.test(value);
                isValid ? showSuccess(errorId) : showError(input, message, errorId);
                return isValid;
            }

            function validatePassword() {
                const input = document.getElementById('newPassword');
                const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
                const message =
                    'Password must be at least 6 characters long with an uppercase letter, a digit, and a special character.';
                return validateField(input, regex, message, 'password-error');
            }

            function validateConfirmPassword() {
                const passwordInput = document.getElementById('newPassword');
                const confirmPasswordInput = document.getElementById('confirmPassword');
                const message = 'Passwords do not match.';
                return validateField(confirmPasswordInput, new RegExp(`^${passwordInput.value}$`), message,
                    'confirm-password-error');
            }

            function validateForm() {
                return validatePassword() && validateConfirmPassword();
            }

            form.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                } else {
                    // Validation passed, submit the form
                    alert('Form submitted successfully!');
                }
            });

            form.addEventListener('input', function(event) {
                const inputElement = event.target;
                switch (inputElement.id) {
                    case 'newPassword':
                        validatePassword();
                        break;
                    case 'confirmPassword':
                        validateConfirmPassword();
                        break;

                    default:
                        break;
                }
            });
        });
        </script>

        <!-- forgot password section ends here -->






        <!-- Sign In End -->
    </div>

    <!-- JavaScript code for real-time password validation -->
    <!-- Add this script inside your HTML file, preferably at the end of the body tag -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>