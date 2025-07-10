<?php
// Include your database connection and other necessary configurations
include('inc/config.php');
session_start();
$email = $_SESSION['user_email'];
if(!isset($email)) {
    header('location:login.php');
}

if(isset($_POST['book'])) {
    // Retrieve form data
    $ptype = $_POST['packagetype'];
    $wpoint = $_POST['washingpoint'];   
    $fname = $_POST['fname'];
    $mobile = $_POST['contactno'];
    $date = $_POST['washdate'];
    $time = $_POST['washtime'];
    $message = $_POST['message'];
    $status = 'New';
    $bno = mt_rand(100000000, 999999999);

    // Validate date and time
    $currentDate = new DateTime();
    $selectedDateTime = new DateTime("$date $time");
    
    if ($selectedDateTime < $currentDate) {
        echo '<script>alert("Please select a future date and time.")</script>';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO tblcarwashbooking(bookingId, packageType, carWashPoint, fullName, mobileNumber, washDate, washTime, message, status) VALUES(:bno, :ptype, :wpoint, :fname, :mobile, :date, :time, :message, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bno', $bno, PDO::PARAM_STR);
        $query->bindParam(':ptype', $ptype, PDO::PARAM_STR);
        $query->bindParam(':wpoint', $wpoint, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':time', $time, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<script>alert("Your booking done successfully. Booking number is ' . $bno . '")</script>';
            // Redirect to the payment page
            echo "<script>window.location.href ='payment.php?booking_id=$bno'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
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
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">


    </head>
<style>
    /* Custom CSS for Car Wash Booking Page */
    <style> /* Custom CSS for Car Wash Booking Page */ /* Blue Color CSS */ :root { --blue: #3399ff; --light-blue: #e6f2ff; --dark-blue: #66b3ff; } /* Body Styles */ body { background-color: var(--light-blue); font-family: 'Barlow', sans-serif; } /* Header Styles */ .header-area { background-color: var(--blue); } .main-menu ul li a { color: #fff; text-transform: uppercase; font-weight: 500; transition: 0.3s ease-in-out; } .main-menu ul li a:hover { color: var(--light-blue); } /* Price Styles */ .price { padding: 60px 0; } .price-item { background-color: #fff; padding: 40px 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); } .price-item h3 { font-size: 24px; font-weight: bold; margin-bottom: 20px; } .price-item h2 { font-size: 48px; font-weight: bold; color: var(--blue); margin-bottom: 20px; } .price-item ul { list-style: none; padding: 0; margin: 0; } .price-item ul li { margin-bottom: 15px; font-size: 18px; } .price-item .btn-custom { background-color: var(--blue); color: #fff; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-transform: uppercase; transition: 0.3s ease-in-out; } .price-item .btn-custom:hover { background-color: var(--dark-blue); } /* Form Styles */ .form-control { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 16px; } .form-control:focus { box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); } .modal-header { background-color: var(--blue); } .modal-title { color: #fff; } /* Responsive Styles */ @media (max-width: 767px) { .price-item { margin-bottom: 50px; } } </style>

</style>

    <body>

    
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

        
        <!-- Header End -->
    </header>
        
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Washing Plan</h2>
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Price Start -->
        <div class="price">
            <div class="container">
                <div class="section-header text-center">
                    <p>Washing Plan</p>
                    <h2>Choose Your Plan</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>NORMAL Cleaning</h3>
                                <h2><span></span><strong>499</strong><span></span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                    <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                    <li><i class="far fa-times-circle"></i>Interior Wet Cleaning</li>
                                    <li><i class="far fa-times-circle"></i>Window Wiping</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <a class="btn btn-custom"  data-toggle="modal" data-target="#myModal">Book Now</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item featured-item">
                            <div class="price-header">
                                <h3>STANDARD Cleaning</h3>
                                <h2><span></span><strong>999</strong><span></span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                    <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                    <li><i class="far fa-times-circle"></i>Window Wiping</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <a class="btn btn-custom" data-toggle="modal" data-target="#myModal">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>DYNAMIC Cleaning</h3>
                                <h2><span></span><strong>1999</strong><span></span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                    <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Window Wiping</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <a class="btn btn-custom" data-toggle="modal" data-target="#myModal">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Price End -->
        
       <?php include_once('inc/footer.php');?>

<!--Model-->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Car Wash Booking</h4>
        </div>
        <div class="modal-body">
<form method="post">   
  <p>
            <select name="packagetype" required class="form-control">
                <option value="">Package Type</option>
                <option value="1">NORMAL CLEANING (499)</option>
                 <option value="2">STANDARD CLEANING (999)</option>
                  <option value="3 ">DYNAMIC CLEANING(1999)</option>
              </select>

          <p>
            <select name="washingpoint" required class="form-control">
                <option value="">Select Washing Point</option>
                <option value="1">ranni</option>
                 <option value="2">kottayam</option>
                  <option value="3 ">alluva</option>

<?php $sql = "SELECT * from tblwashingpoints";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{               ?>  
    <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->washingPointName);?> (<?php echo htmlentities($result->washingPointAddress);?>)</option>
<?php } ?>
            </select></p>
            <p><input type="text" name="fname" class="form-control" required placeholder="Full Name"></p>
            <p><input type="text" name="contactno" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required placeholder="Mobile No."></p>
            <p>Wash Date <br /><input type="date" name="washdate" required class="form-control"></p>
             <p>Wash Time <br /><input type="time" name="washtime" required class="form-control"></p>
             <p><textarea name="message"  class="form-control" placeholder="Message if any"></textarea></p>
             <p><input type="submit" class="btn btn-custom" name="book" value="Book Now"></p>
      </form>
        </div>
        <div class="modal-body">
    <div id="locationWindow">
        <!-- Location window content -->
        Location details...
    </div>
    <div id="receiptWindow" style="display: none;">
        <!-- Receipt window content -->
        Receipt details...
    </div>
    <div id="paymentWindow" style="display: none;">
        <!-- Payment window content -->
        Payment details...
    </div>
    <div>
        <button onclick="showLocationWindow()">Location</button>
        <button onclick="showReceiptWindow()">Receipt</button>
        <button onclick="showPaymentWindow()">Payment</button>
    </div>
</div>

<script>
    function showLocationWindow() {
        document.getElementById('locationWindow').style.display = 'block';
        document.getElementById('receiptWindow').style.display = 'none';
        document.getElementById('paymentWindow').style.display = 'none';
    }

    function showReceiptWindow() {
        document.getElementById('locationWindow').style.display = 'none';
        document.getElementById('receiptWindow').style.display = 'block';
        document.getElementById('paymentWindow').style.display = 'none';
    }

    function showPaymentWindow() {
        document.getElementById('locationWindow').style.display = 'none';
        document.getElementById('receiptWindow').style.display = 'none';
        document.getElementById('paymentWindow').style.display = 'block';
    }
</script>


<script>
    function showLocationWindow() {
        // Open the location page in a new window or tab
        window.open('location.php', '_blank');
    }

    function showReceiptWindow() {
        // Code to show receipt window
    }

    function showPaymentWindow() {
        // Code to show payment window
    }
</script>


        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

        <script>
    // Function to validate date and time
    function validateDateTime() {
        var currentDate = new Date();
        var currentTime = currentDate.getTime();

        var selectedDate = new Date(document.getElementsByName("washdate")[0].value);
        var selectedTime = new Date("1970-01-01T" + document.getElementsByName("washtime")[0].value + "Z").getTime();

        if (selectedDate < currentDate || (selectedDate.getTime() === currentDate.getTime() && selectedTime < currentTime)) {
            alert("Please select a future date and time.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

    </body>
</html>
