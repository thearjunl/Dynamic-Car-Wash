<?php
session_start();
require '../vendor/autoload.php'; // Include Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Email'])) {
    // Generate a random 6-digit verification code
    $verificationCode = rand(100000, 999999);

    // Store the verification code in the session
    $_SESSION['verification_code'] = $verificationCode;

    // Get the user's email from the URL
    $email = $_GET['Email'];
    $_SESSION['email']= $email;

    // Send the verification email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aldif223683@gmail.com'; // Replace with your Gmail address
        $mail->Password   = 'gtcu ngmc dukd kczi'; // Replace with your Gmail password or App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('aldif223683@gmail.com', 'Mailer'); // Replace with your name
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Gmail Verification Code';
        $mail->Body    = "Your verification code is: $verificationCode";

        $mail->send();
        header("Location: verification_form.php");
        exit; // Make sure to exit after sending the header to prevent further execution

    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
