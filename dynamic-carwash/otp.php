<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgot_password.php");
}

$email = $_SESSION['forgot_password_email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require ('../vendor/autoload.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = "dynamic";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {

    if (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        $checkSql = "SELECT * FROM login WHERE email = '$email'";
        $result = $conn->query($checkSql);

        // Check if the query was successful
        if ($result) {
            // Fetch the data from the result set
            while ($row = $result->fetch_assoc()) {
                // Output the email to the console
                // Note: The correct syntax is console.log, not console . log
                $otpCheck = $row['Gcode'];

                echo "<script>console.log('" . $row['Gcode'] . "');</script>";
            }
        } else {
            // Handle the case where the query was not successful
            echo "<script>alert('Query failed: " . $conn->error . "');</script>";
        }
        if ($otpCheck == $otp) {

             header("Location: reset_password.php");
            exit();
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


    <!-- Bootstrap JS and Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


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
                            <h5>OTP</h5>
                        </div>
                        <form action="#" method="post" onsubmit="return validateForm()">
                            <!-- Added onsubmit attribute -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="otp" id="floatingInput"
                                    placeholder="OTP" oninput="validateUsername()">
                                <label for="floatingInput">Enter your OTP</label>
                            </div>

                            <!-- Countdown timer -->
                            <div id="countdown" style="color: #007bff;"></div>

                            <!-- Error message div -->
                            <div id="errorMessage"></div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleCheck1" style="color: lightgreen;">
                                        Enter the OTP received in your registered Email Address!
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit OTP
                            </button>
                        </form>

                        <!-- Back button -->
                        <a href="./signin.php" class="btn btn-outline-primary">&#8249; Back</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // Set the countdown duration in seconds
        const countdownDuration =
            1000; // 10 seconds (for testing purposes, change it to 300 for 5 minutes in production)

        // Initialize the countdown
        let countdown = countdownDuration;

        // Function to update the countdown timer
        function updateCountdown() {
            const minutes = Math.floor(countdown / 60);
            const seconds = countdown % 60;
            document.getElementById('countdown').innerHTML = `Time remaining: ${minutes}m ${seconds}s`;

            if (countdown === 0) {
                // Redirect to forgotpassword.php when countdown reaches zero
                window.location.href = "./forgotpassword.php";
                // Reset session variables here if needed
                sessionStorage.clear(); // Clear all session storage
            } else {
                countdown--;
                setTimeout(updateCountdown, 1000); // Update every second
            }
        }

        // Start the countdown when the page loads
        updateCountdown();
        </script>

        <!-- forgot password section ends here -->






        <!-- Sign In End -->
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('floatingInput').addEventListener('input', function() {
            validateEmail();
        });
    });

    function validateEmail() {
        var otpInput = document.getElementById('floatingInput').value.trim();
        var errorMessageDiv = document.getElementById('errorMessage');

        // Use a regex to match exactly 6 digits
        var otpRegex = /^\d{6}$/;

        if (!otpRegex.test(otpInput)) {
            errorMessageDiv.textContent = 'Enter valid 6 digit OTP';
        } else {
            errorMessageDiv.textContent = '';
        }
    }

    // Add an event listener to the input field
    document.getElementById('floatingInput').addEventListener('input', function() {
        var input = this.value.trim();
        var errorMessageDiv = document.getElementById('errorMessage');

        // Limit the input to 6 digits
        if (input.length > 6) {
            // Truncate the input to 6 digits
            this.value = input.slice(0, 6);
            errorMessageDiv.textContent = 'Only 6 digits allowed';
        } else {
            errorMessageDiv.textContent = '';
        }
    });

    function validateForm() {
        var emailInput = document.getElementById('floatingInput').value.trim();
        var errorMessageDiv = document.getElementById('errorMessage');

        var emailRegex = /^[0-9]{2,6}$/;

        if (emailInput.length < 4 || !emailRegex.test(emailInput)) {
            // Display error message
            errorMessageDiv.textContent = 'Invalid email address';
            // Prevent form submission
            return false;
        }

        // Form is valid, allow submission
        return true;
    }
    </script>

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