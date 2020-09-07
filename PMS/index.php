<?php
include("TrafficOICComp/php/dbconnect.php");


// $sub = "Police Department";
// $msg = "You Driver Licence is Cancelled Please Come to The Police";

$sql = "UPDATE driver_tbl SET status='Suspend' WHERE rate>50 ";
$result = mysqli_query($conn, $sql)
  or die('Error querying database.');

$date =  date('Y-m-d');
$check = "SELECT * FROM spot_fine_tbl WHERE expire_date < '" . $date . "' AND statuspay='Pending' ";
$result2 = mysqli_query($conn, $check);
while ($rowe = mysqli_fetch_array($result2)) {
  $liceno = $rowe['driverLicNo'];

  $sql2 = "UPDATE driver_tbl SET status='Suspend' WHERE driverLicNo = '" . $liceno . "' ";
  $result3 = mysqli_query($conn, $sql2);

  $sql3 = "UPDATE spot_fine_tbl SET statuspay='consequece' WHERE expire_date < '" . $date . "' ";
  $result4 = mysqli_query($conn, $sql3)
    or die('Error querying database.');
  // $getemail = "SELECT email FROM driver_tbl WHERE driverLicNo = '" . $liceno . "'";
  // $getemailreslt = mysqli_query($conn, $getemail);
  // while ($rowemail = mysqli_fetch_array($getemailreslt)) {
  //   $emaildrv = $rowemail['email'];
  //   mail($emaildrv, $sub, $msg);
  // }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Police Department</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="manifest" href="site.webmanifest" />
  <!-- <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.ico"
    /> -->

  <!-- CSS here -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="assets/css/flaticon.css" />
  <link rel="stylesheet" href="assets/css/slicknav.css" />
  <link rel="stylesheet" href="assets/css/animate.min.css" />
  <link rel="stylesheet" href="assets/css/magnific-popup.css" />
  <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
  <link rel="stylesheet" href="assets/css/themify-icons.css" />
  <link rel="stylesheet" href="assets/css/slick.css" />
  <link rel="stylesheet" href="assets/css/nice-select.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <!-- Preloader Start -->
  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
      <div class="preloader-inner position-relative">
        <div class="preloader-circle"></div>
        <div class="preloader-img pere-text">
          <img src="assets/img/logo/policeman.jpg" alt="" />
        </div>
      </div>
    </div>
  </div>
  <!-- Preloader Start -->

  <header>
    <!-- Header Start -->
    <div class="header-area header-transparrent">
      <div class="main-header header-sticky">
        <div class="container">
          <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-xl-2 col-lg-2 col-md-1">
              <div class="logo">
                <a href="index.html"><img src="assets/img/logo/policemannew.jpg" alt="" /></a>
              </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8">
              <!-- Main-menu -->
              <div class="main-menu f-right d-none d-lg-block">
                <nav>
                  <ul id="navigation">
                    <li><a href="#"> Home</a></li>
                    <li><a href="DepartmentComp/login.php">Department</a></li>
                    <li>
                      <a href="TrafficOICComp/login.php">Traffic OIC</a>
                    </li>
                    <li>
                      <a href="LoginPageOfficer/login.php">Officer</a>
                    </li>
                    <li>
                      <a href="http://localhost/finalviva-hdv2/LoginpageDriver/index.php">Driver</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3">
              <div class="header-right-btn f-right d-none d-lg-block">
                <a href="http://localhost/finalviva-hdv2/ContactFrom_v1/" class="btn header-btn">Contact Us</a>
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
    <!-- Header End -->
  </header>

  <main>
    <!-- Slider Area Start-->
    <div class="slider-area">
      <div class="slider-active">
        <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.png">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-lg-7 col-md-9">
                <div class="hero__caption">
                  <h1 data-animation="fadeInLeft" data-delay=".4s">
                    Police Department Sri Lanka
                  </h1>
                  <p data-animation="fadeInLeft" data-delay=".6s">
                    Welcome to the official site of the Police Department of Sri Lanka.<br>
                    This portal can be used to pay spot fines and provide feedback to the department
                  </p>
                  <!-- Hero-btn -->
                  <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                    <a href="http://localhost/finalviva-hdv2/LoginpageDriver/index.php" class="btn hero-btn">PAY NOW</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
                  <img src="assets/img/hero/hero_right.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <!div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.png">
          <!div class="container">
            <!div class="row d-flex align-items-center">
              <!div class="col-lg-7 col-md-9">
                <!div class="hero__caption">
                  <!-- Hero-btn -->
                  <!div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                    <a href="industries.html" class="btn hero-btn">Contact Us</a>
      </div>
    </div>
    </div>
    <!div class="col-lg-5">
      <!div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
        <!img src="assets/img/hero/hero_right.png" alt="" />
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!-- Slider Area End-->

        <!-- We Create Start -->
        <div class="we-create-area create-padding">
          <div class="container">
            <div class="row d-flex align-items-end">
              <div class="col-lg-6 col-md-12">
                <div class="we-create-img">
                  <img src="assets/img//service/we-create.png" alt="" />
                </div>
              </div>
              <div class="col-lg-6 col-md-12">
                <div class="we-create-cap">
                  <h3>Pay spot fines at your convinience</h3>
                  <p>
                    Spot fines issued can now be simply paid online through this medium.
                  </p>
                  <a href="http://localhost/finalviva-hdv2/LoginpageDriver/index.php" class="btn">Pay now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- We Create End -->

        <!-- Testimonial Start -->
        <div class="testimonial-area">
          <div class="container">
            <div class="testimonial-main">
              <!-- Section-tittle -->
              <div class="row d-flex justify-content-center">
                <div class="col-lg-5 col-md-8 pr-0">
                  <div class="section-tittle text-center">
                    <h2>Feedback corner</h2>
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-lg-10 col-md-9">
                  <div class="h1-testimonial-active">
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                      <div class="testimonial-caption">
                        <div class="testimonial-top-cap">
                          <p>
                            This website makes spot fine payment way easier. Great work!
                          </p>
                        </div>
                        <!-- founder -->
                        <div class="testimonial-founder d-flex align-items-center justify-content-center">
                          <div class="founder-img">
                            <!img src="assets/img/testmonial/testimonial.png" alt="" />
                          </div>
                          <div class="founder-text">
                            <span>Kevin Peter</span>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                      <div class="testimonial-caption">
                        <div class="testimonial-top-cap">
                          <p>
                            Wonderful initiative! Appreciate how this easens our work and saves a lot of time.
                          </p>
                        </div>
                        <!-- founder -->
                        <div class="testimonial-founder d-flex align-items-center justify-content-center">
                          <div class="founder-img">
                            <!img src="assets/img/testmonial/testimonial.png" alt="" />
                          </div>
                          <div class="founder-text">
                            <span>Nimal Perera</span>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Testimonial End -->

        <!-- have-project Start--><br><br>
        <div class="have-project">
          <div class="container">
            <div class="haveAproject" data-background="assets/img/team/have.jpg">
              <div class="row d-flex align-items-center">
                <div class="col-xl-7 col-lg-9 col-md-12">
                  <div class="wantToWork-caption">
                    <h2>Have feedback?</h2>
                    <p>
                      Provide us your comments and suggestions so that we can improve this feature further and serve the best to the citizens of our country.
                    </p>
                  </div>
                </div>
                <div class="col-xl-5 col-lg-3 col-md-12">
                  <div class="wantToWork-btn f-right">
                    <a href="http://localhost/finalviva-hdv2/ContactFrom_v1/" class="btn btn-ans">Feedback</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- have-project End -->
  </main>
  <footer>
    <center>
      <div class="footer-main" data-background="assets/img/shape/footer_bg.png">
        <!div class="footer-area footer-padding"><br><br><br>
          <div class="container">
            <!div class="row d-flex justify-content-between">
              <!div class="col-lg-3 col-md-4 col-sm-8">
                <!div class="single-footer-caption mb-50">
                  <!div class="single-footer-caption mb-30">
                    <!-- logo -->
                    <div class="footer-logo">
                      <a href="index.html">
                        <!img src="assets/img/logo/logo2_footer.png" alt="" /></a>
                    </div>
                    <div class="footer-tittle">
                      <div class="footer-pera">
                        <p class="info1">
                          Galle Road, <br />
                          Colombo
                        </p>
                        <p class="info2">0112345678<br>info@SLPolice.com</p>
                      </div>
                    </div>

          </div>
    </center>
  </footer>

  <!-- JS here -->

  <!-- All JS Custom Plugins Link Here here -->
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
  <!-- Date Picker -->
  <script src="./assets/js/gijgo.min.js"></script>
  <!-- One Page, Animated-HeadLin -->
  <script src="./assets/js/wow.min.js"></script>
  <script src="./assets/js/animated.headline.js"></script>
  <script src="./assets/js/jquery.magnific-popup.js"></script>

  <!-- Scrollup, nice-select, sticky -->
  <script src="./assets/js/jquery.scrollUp.min.js"></script>
  <script src="./assets/js/jquery.nice-select.min.js"></script>
  <script src="./assets/js/jquery.sticky.js"></script>

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