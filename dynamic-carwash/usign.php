<?php
require("db_connect.php");
$message = "";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $query = "SELECT * FROM login WHERE email = '$Email'";
    $result = $conn->query($query);                                                     
    if ($result->num_rows > 0) {
        echo '<script>
        window.onload = function() {
            swal("Error!", "The email is already existed", "error");
        }
      </script>';
    } else {

$name = $_POST['Name'];
$phone = $_POST['Phone'];
$email = $_POST['Email'];
$password = $_POST['password'];
$loginQuery = "INSERT INTO login (email, password,user_type,status) VALUES ('$email', '$password','User','0')";

if ($conn->query($loginQuery) === TRUE) {
    $loginId = $conn->insert_id;
    $uregQuery = "INSERT INTO signup (id, name, phone) VALUES ('$loginId', '$name', '$phone')";

    if ($conn->query($uregQuery) === TRUE) {
        // echo '<script>
        // window.onload=function(){
        //     swal("Success","Registration Successfull","success").then(function() {
        //         window.location = "login.php";
        //     });
        // }
        // </script>';
        echo "<script>window.location = 'verification.php?Email=$Email';</script>";
    } else {
        echo "Error inserting into signup: " . $conn->error;
    }
} else {
    echo "Error inserting into login: " . $conn->error;
}}}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dynamic Car wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

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

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
    section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        width: 100%;
    }

    .form-box {
        position: relative;
        margin-top: 50px;
        width: 400px;
        padding: 30px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.8);
        /* Transparent background with some opacity */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        height: auto;
        /* Set height to auto */
    }


    h2 {
        font-size: 2em;
        color: #040404;
        text-align: center;
        margin-top: 10px;
    }

    .inputbox {
        margin: 20px 0;
        position: relative;
    }

    .inputbox label {
        display: block;
        font-size: 0.8em;
        margin-bottom: 5px;
    }

    .inputbox input {
        width: calc(100% - 20px);
        height: 40px;
        background: transparent;
        border: 2px solid #000000;
        border-radius: 20px;
        outline: none;
        font-size: 1em;
        padding: 0 10px;
        color: #000000;
        margin-bottom: 10px;
    }


    .error-message {
        color: red;
        font-size: 0.8em;
        /* margin-top: 5px; */
        /* Adjust margin-top as needed */
        /* position: absolute; */
        bottom: 0;
        left: 0;
    }

    button[type="submit"] {
        width: 50%;
        height: 40px;
        color: #fff;
        background: #ff0000;
        border: 2px solid black;
        border-radius: 10px;
        outline: none;
        cursor: pointer;
        font-size: 1em;
        font-weight: 600;
        margin-top: 20px;
        margin-left: 85px;
        transition: all 0.3s ease;
        align-items: center;
    }

    button[type="submit"]:hover {
        background-color: #fff;
        color: black;
        border-color: #040404;
    }
    </style>
    <script src="sweetalert.min.js"></script>
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
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
                                                        <li><a href="blog.html">Normal Wash</a></li>
                                                        <li><a href="blog_details.html">Standard Wash</a></li>
                                                        <li><a href="elements.html">Dynamic Wash</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="login.php">Login</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header-btn -->
                                    <div class="header-right-btn d-none d-lg-block ml-20">
                                        <a href="contact.html" class="btn header-btn"><img src="assets/img/icon/smartphone.svg" alt=""> 95447860788</a>
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
        </header>
        <!-- end header section -->
    </div>

    <!-- about section -->
    <section>
        <div class="form-box">
            <h2> SIGN UP</h2>
            <form action="#" method="post" onsubmit="return loginup()">
                <div class="inputbox">
                    <label for="Name">Name:</label>
                    <input type="text" id="name" name="Name">
                    <div class="error-message" id="e1"></div>
                </div>
                <div class="inputbox">
                    <label for="Email">Email:</label>
                    <input type="text" id="Email" name="Email">
                    <div class="error-message" id="e2"><?php echo $message?></div>

                </div>
                <div class="inputbox">
                    <label for="Phone">Phone:</label>
                    <input type="text" id="Phone" name="Phone">
                    <div class="error-message" id="e3"></div>
                </div>
                <div class="inputbox">
                    <label for="pass">Password:</label>
                    <input type="password" id="password" name="password">
                    <div class="error-message" id="e4"></div>
                </div>
                <div class="inputbox">
                    <label for="cpass">Confirm Password:</label>
                    <input type="password" id="cpass" name="cpass">
                    <div class="error-message" id="e5"></div>
                </div>
                <button type="submit" id="signup-button" name="submit">Submit</button>
            </form>
        </div>
    </section>

    <script>
    var test = /^(?:[A-Z][a-zA-Z]*)(?: [A-Z][a-zA-Z]*)*$/;
    var test1 = /^[6-9](?:(?!(\d)\1{3})\d){9}$/
    var test2 =/^(?!\.)(?!.*\.\.)(?=.*[a-zA-Z])[^\s@]{3,}(?<!\d{7,})@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com|icloud\.com|aol\.com|mail\.com|protonmail\.com|yandex\.com|gmx\.com|zoho\.com)$/;
    var test3 = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/;
    var Name = document.getElementById('name');
    var Phone = document.getElementById('Phone');
    var Email = document.getElementById('Email');
    var pass = document.getElementById('pass');
    var cpass = document.getElementById('cpass');
    var loc = document.getElementById('location');
    var e1 = document.getElementById('e1');
    var e2 = document.getElementById('e2');
    var e3 = document.getElementById('e3');
    var e4 = document.getElementById('e4');
    var e5 = document.getElementById('e5');
    var e6 = document.getElementById('e6');

    document.addEventListener("DOMContentLoaded", function() {

        Name.addEventListener('blur', function() {
            if (Name.value === "") {
                e1.style.color = "red";
                e1.innerHTML = "*Enter the Full Name";
                return false;
            } else if (!Name.value.match(test)) {
                e1.style.color = "red";
                e1.innerHTML = "*Name should Start with capital letter,contain only alphabets & no leading spaces";
                return false;
            } else {
                e1.innerHTML = "";
                return true;
            }
        });

        Email.addEventListener('blur', function() {
            if (Email.value === "") {
                e2.style.color = "red";
                e2.innerHTML = "*Enter the Email";
                return false;
            } else if (!Email.value.match(test2)) {
                e2.style.color = "red";
                e2.innerHTML = "*Enter correct Email-Format & no leading spaces, eg-email12@gmail.com";
                return false;
            } else {
                e2.innerHTML = "";
                return true;

            }
        });

        Phone.addEventListener('blur', function() {
            if (Phone.value === "") {
                e3.style.color = "red";
                e3.innerHTML = "*Enter the Phone";
                return false;
            } else if (!Phone.value.match(test1)) {
                e3.style.color = "red";
                e3.innerHTML = "*Enter valid Phone number,should contain only 10 digits & digit start Swith 6,7,8,9";
                return false;
            } else {
                e3.innerHTML = "";
                return true;
            }
        });

        pass.addEventListener('blur', function() {
            if (pass.value === "") {
                e4.style.color = "red";
                e4.innerHTML = "*Enter the Password";
                return false;
            } else if (!pass.value.match(test3)) {
                e4.style.color = "red";
                e4.innerHTML ="*Password must be at least 6 characters long with an uppercase letter, a digit,a special character & no leading spaces";
                return false;
            } else {
                e4.innerHTML = "";
                return true;
            }
        });

        cpass.addEventListener('blur', function() {
            if (cpass.value === "") {
                e5.style.color = "red";
                e5.innerHTML = "*Enter the Confirm Password";
                return false;
            } else if (pass.value !== cpass.value) {
                e5.style.color = "red";
                e5.innerHTML = "Passwords do not match";
                return false;
            } else {
                e5.innerHTML = "";
                return true;
            }
        });
    });

    function loginup() {
        var isValid = true;
        if (Name.value === "") {
            e1.style.color = "red";
            e1.innerHTML = "*Enter a valid Name";
            Name.focus();
            isValid = false;
        }

        if (Email.value === "") {
            e2.style.color = "red";
            e2.innerHTML = "*Enter a valid Email";
            Email.focus();
            isValid = false;
        }
        if (Phone.value === "") {
            e3.style.color = "red";
            e3.innerHTML = "*Enter a valid Phone";
            Phone.focus();
            isValid = false;
        }
        if (pass.value === "" || !pass.value.match(/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,16}$/)) {
            e4.style.color = "red";
            e4.innerHTML = "*Enter a valid Password";
            pass.focus();
            isValid = false;
        }
        if (cpass.value === "" || pass.value !== cpass.value) {
            e5.style.color = "red";
            e5.innerHTML = "*Passwords do not match";
            cpass.focus();
            isValid = false;
        }

        return isValid;
    }
    </script>
    <footer class="container-fluid footer_section" style="margin-top: 100px;">
        <p>
            Copyright &copy; 2020 All Rights Reserved. 
           
        </p>
    </footer>
    <!-- footer section -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/custom.js"></script>

</body>

</html>