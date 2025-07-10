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

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust as needed */
        }
        .box {
            width: 300px; /* Adjust as needed */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

    
<body class="full-wrapper">
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
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
        <!-- Header End -->
    </header>

    <main>
   
<!-- Display the amount to be paid -->
<div id="paymentAmount"></div>
<div class="container">
    <div class="box">
        <!-- Display the amount to be paid -->
        <div id="paymentAmount"></div>

        <!-- Add this button within your modal body where you want to display payment -->
        <select id="packagetype" onchange="calculateAmount()">
            <option value="1">Package 1 - 499 INR</option>
            <option value="2">Package 2 - 599 INR</option>
            <option value="3">Package 3 - 999 INR</option>
        </select>

        <!-- Add this button within your modal body where you want to display payment -->
        <button id="rzp-button1" class="btn btn-custom">Pay Now</button>
    </div>
</div>
<!-- Add this script at the end of your HTML body -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Function to calculate the amount dynamically based on the selected package type
function calculateAmount() {
    // Retrieve the selected package type
    var packageType = document.getElementById('packagetype').value;

    // Define the price for each package type (in paise)
    var prices = {
        '1': 499,
        '2': 599,
        '3': 999
    };

    // Calculate the amount based on the selected package type
    var amount = prices[packageType];

    // Display the amount to be paid
    document.getElementById('paymentAmount').innerHTML = 'Amount to be paid: ' + amount + ' INR';

    // Update the Razorpay payment amount
    options.amount = amount * 100; // Converting INR to paise
}

var options = {
    "key": "rzp_test_diEXdA4UD2CMLb", // Replace with your Razorpay API key
    "amount": 499 * 100, // Initial amount (dummy amount)
    "currency": "INR", // Currency code
    "name": "Dynamic Car Wash", // Name of your company
    "description": "Car Wash Service", // Description of the product/service
    "image": "https://example.com/your_logo.png", // Your company logo (optional)
    "handler": function (response){
        // Callback function to handle successful payment
        // Send the payment ID and other details to your server for validation
        var paymentId = response.razorpay_payment_id;
        // Now, submit the form or make an AJAX call to your server to save payment details
        // Example: submitForm(paymentId);
    },
    "prefill": {
        "name": " ", // Customer's name
        "email": "john.doe@example.com" // Customer's email (optional)
    },
    "theme": {
        "color": "#3399ff" // Color of the payment button
    }
};

// Create a Razorpay instance
var rzp1 = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e) {
    // Open the Razorpay payment window
    rzp1.open();
    e.preventDefault();
}
</script>


<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>
</html>
