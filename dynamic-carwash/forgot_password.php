<?php


// Start or resume the session
session_start();

// Reset session variables as needed
$_SESSION = array(); // Reset all session variables

// Destroy the session
session_destroy();

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require ( '../vendor/autoload.php' );

$servername = "localhost";
$username = "root";
$password = "";
$database = "dynamic";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $randomOTP = mt_rand(100000, 999999);
        echo "<script>console.log('" . $randomOTP . "')</script>";

        $updateSql = "UPDATE login SET Gcode = $randomOTP WHERE email = '$email'";

        if ($conn->query($updateSql)) {
            $_SESSION['forgot_password_email'] = $email;

            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = 0;                // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'aldif223683@gmail.com';       // SMTP username
                $mail->Password   = 'gtcu ngmc dukd kczi';                  // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable explicit TLS encryption
                $mail->Port       = 587;                                    // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                $mail->isHTML(true);
                // Recipients
                $mail->setFrom('arjunl2026@mca.ajce.in', 'Arjun');
                $mail->addAddress($email);  // Add a recipient

                // Set email format to HTML
                $mail->Subject = 'Password Reset OTP for Your Account';
                $mail->Body = '
                <html>
                <body>
                    <h1>Password Reset OTP</h1>
            
                    <p>Dear [User],</p>
            
                    <p>We have received a request to reset the password for your account associated with the email address <strong>[user@email.com]</strong>. To proceed with the password reset, please use the following One-Time Password (OTP):</p>
            
                    <h2>Your OTP: <span style="color: #007bff;">' . $randomOTP . '</span></h2>
            
                    <p>Please enter this OTP on the password reset page to complete the process. If you did not initiate this request, please ignore this email. Ensure the security of your account by not sharing this OTP with anyone.</p>
            
                    <p>If you have any questions or concerns, please contact our support team.</p>
            
                    <p>Thank you, <br>[Your Company Name] Team</p>
                </body>
                </html>';

                $mail->send();
                echo "<script>alert('Message send')</script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            header("Location: otp.php");
            echo "<script>alert('Hello12')</script>";
        } else {
            echo "Error: " . $updateSql . "<br>" . $conn->error;
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

    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

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
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- forgot password section starts here -->


        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="text-decoration-none">
                                <h3 class="text-primary">car wash</h3>
                            </a>
                            <h5>Forgot Password</h5>
                        </div>
                        <form action="#" method="post" onsubmit="return validateForm()">
                            <!-- Added onsubmit attribute -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Username" oninput="validateUsername()">
                                <label for="floatingInput">Enter your email address</label>
                            </div>

                            <!-- Error message div -->
                            <div id="errorMessage"></div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleCheck1" style="color: lightgreen;">
                                        Enter your registered Email Address of your account!
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Send OTP
                                !</button>
                        </form>

                        <!-- Back button -->
                        <a href="login.php" class="btn btn-outline-primary">&#8249; Back</a>
                    </div>
                </div>
            </div>
        </div>



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
            var emailInput = document.getElementById('floatingInput').value.trim();
            var errorMessageDiv = document.getElementById('errorMessage');

            var emailRegex = /^[a-zA-Z]+[a-zA-Z0-9._]*@[a-zA-Z]+\.[a-zA-Z]{2,4}$/;

            if (emailInput.length < 4 || !emailRegex.test(emailInput)) {
                errorMessageDiv.textContent = 'Invalid email format';
            } else {
                errorMessageDiv.textContent = '';
            }
        }

        function validateForm() {
            var emailInput = document.getElementById('floatingInput').value.trim();
            var errorMessageDiv = document.getElementById('errorMessage');

            var emailRegex = /^[a-zA-Z]+[a-zA-Z0-9._]*@[a-zA-Z]+\.[a-zA-Z]{2,4}$/;

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