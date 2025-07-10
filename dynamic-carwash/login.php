
<?php
session_start(); 

$_SESSION = array();


$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'dynamic';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation
    if(empty($email) || empty($password)) {
        $message = "Email and password are required!";
    } else {
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        $sql = "SELECT * FROM login WHERE  email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if ($user['user_type'] === 'User') {
                $_SESSION['user_type'] = 'User';
                $_SESSION['user_email'] = $email;
                echo'<script>
                window.onload = function(){
                swal("Error!","authentication failed","error")}</script>';  
                header("Location: index.html");
                exit;
            } elseif ($user['user_type'] === 'admin') {
                $_SESSION['user_type'] = 'admin';

                header("Location: dashboard.php");
                exit;
            }
        } else {
            echo'<script>
            window.onload = function(){
            swal("Error!","authentication failed","error")}</script>';  
        }
    }
}

?>


<!DOCTYPE html>
<!-- coding by helpme_coder -->
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Dynamic Car wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="log.css">
    <script src="./sweetalert.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Open Sans", sans-serif;
}

bodya {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  width: 100%;
  padding: 0 10px;
}

 bodya {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: url("colorful-wallpaper-background-multicolored-generative-ai.jpg"), #000;
  background-position: center;
  background-size: cover;
} 

.log .container {
  width: 400px;
  border-radius: 8px;
  padding: 30px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(7px);
  -webkit-backdrop-filter: blur(7px);
}

.log form {
  display: flex;
  flex-direction: column;
}

.log h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #fff;
}

.log .input-field {
  position: relative;
  border-bottom: 2px solid #ccc;
  margin: 15px 0;
}

.log .input-field label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: #fff;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
}

.log .input-field input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #fff;
}

.log .input-field input:focus~label,
.log .input-field input:valid~label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
}

.log .forget {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0 35px 0;
  color: white;
}

.log #Save-login {
  accent-color: #fff;
}

.log .forget label {
  display: flex;
  align-items: center;
  
}

.log .forget label p {
  margin-left: 8px;
}

.log .container a {
  color: #efefef;
  text-decoration: none;
}

.log .container a:hover {
  text-decoration: underline;
}

.log button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

.log button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}

.log .Create-account {
  text-align: center;
  margin-top: 30px;
  color: #fff;
}




    </style>

    <script>
    function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        // Simple email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
        // You can add more complex password validation here if needed
        return true;
    }

    // Add onBlur event listeners to the email and password fields
    document.getElementById("email").addEventListener("blur", function() {
        // Perform some action when the email field loses focus
        console.log("Email field blurred");
    });

    document.getElementById("password").addEventListener("blur", function() {
        // Perform some action when the password field loses focus
        console.log("Password field blurred");
    });
</script>
</head>

<body>
<header style="position: absolute;z-index: 1;background-color: aliceblue;width:100%;">
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="index.html">Home</a></li>
                                                <li><a href="about.html">About</a></li>
                                                <li><a href="services.html">Washing Points</a></li>
                                                <li><a href="blog.html">Washing Plans</a>
                                                    <ul class="submenu">
                                                        <li><a href="washing-plans.php">Normal Wash</a></li>
                                                        <li><a href="washing-plans.php">Standard Wash</a></li>
                                                        <li><a href="washing-plans.php">Dynamic Wash</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="login.php">Login</a></li>

                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header-btn -->
                                    <div class="header-right-btn d-none d-lg-block ml-20">
                                        <a href="contact.html" class="btn header-btn"><img src="assets/img/icon/smartphone.svg" alt=""> 9544860788</a>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <bodya>
      <div class="log">

       <div class="container">
       <form id="loginForm" action="#" method="POST" onsubmit="return validateForm()">
    <h2>Login</h2>
    <div class="input-field">
    <input type="text" id="email" name="email" />
    <label for="email" style="font-size: 18px;">Enter email</label>
</div>
<div class="input-field">
    <input type="password" id="password" name="password" />
    <label for="password" style="font-size: 18px;">Enter password</label>
</div>
<div class="forget">
                
                <a href="forgot_password.php">Forgot password?</a>
            </div>
    

    <button type="submit" name="submit">Log In</button>
    <div class="Create-account">
        <p style="color: aliceblue;">Don't have an account? <a href="usign.php">Create account</a></p>
    </div>
</form>
       </div>
      </div>



   </bodya>


</body>

</html>
