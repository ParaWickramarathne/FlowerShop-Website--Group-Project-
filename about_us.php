<?php

@include 'config.php';

session_start(); 

$user_id = $_SESSION['user_id'];  

if(!isset($user_id)){
   header('location:login.php'); 
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> API Flora Online Flower Shop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/vendor/font.awesome.min.css">
    <link rel="stylesheet" href="css/vendor/linearicons.min.css">
    <link rel="stylesheet" href="css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/plugins/animate.min.css">
    <link rel="stylesheet" href="css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="css/plugins/nice-select.min.css">
    <link rel="stylesheet" href="css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
   
<?php @include 'header.php'; ?>
 
<!-- Breadcrumb Area Start Here -->
<div class="breadcrumbs-area position-relative">
        <div class="container"> 
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h1>ABOUT  US</h1>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li style="color:red;">About us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Breadcrumb Area End Here -->

<div class="our-history-area pt-5 mt-text-3">
        <div class="our-history-area">
            <div class="container custom-area">

                <div class="row">
                    <div class="col-12 col-custom">
                        <div class="section-title text-center mb-30">
                            <span class="section-title-1">A little story about us</span>
                            <h2 class="section-title-large">Our History</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="collection-content about-us-container">
                        <img class="img-fluid" src="images/team/1.jpg" alt="">
                        <div class="desc-content">
                            <div class="col-md-6 col-custom order-1 order-md-2">
                                <div class="section-title text-right">
                                    <div class="desc-content">
                                        <p><strong>Welcome to API Flora, your premier destination for exquisite flowers and stunning floral arrangements. With a passion for beauty and a commitment to exceptional customer service, we strive to create memorable experiences through the language of flowers..</strong></p>
                                            <br><p>Founded by Sumudu Jayarathne in 2017, API Flora has blossomed into a renowned floral destination, serving customers with a wide array of enchanting blooms and personalized floral designs. What began as a small family-owned business has grown into a thriving floral haven, dedicated to bringing joy and elegance into the lives of our valued customers.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="shop-collection-area pt-no-text pb-no-text">
        <div class="container custom-area">
            <div class="row mb-30">
                <div class="col-md-6 col-custom">
                    <div class="collection-content">

                        <div class="section-title text-left">
                            <span class="section-title-1">Flowers for the</span>
                            <h3 class="section-title-3 pb-0">Birthday & Gifts</h3>
                        </div>

                        <div class="desc-content">
                            <p>Birthdays are special milestones that deserve to be celebrated with joy, love, and thoughtful gestures. we explore how our online flower shop system can help you make birthdays even more memorable with beautiful flowers and meaningful gifts. Join us as we dive into the world of birthday celebrations and discover unique ways to express your love and appreciation for your dear ones.</p>
                        </div>

                        <a href="birthday.php" class="btn flower-button secondary-btn rounded-0">Our Collection</a>

                    </div>
                </div>

                <div class="col-md-6 col-custom">
                    <div class="single-banner hover-style">
                        <div class="banner-img">
                            <a href="birthday.php">
                                <img src="images/collection/1-1.jpg" alt="">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-custom order-2 order-md-1">
                    
                    <div class="single-banner hover-style">
                        <div class="banner-img">
                            <a href="weddings.php">
                                <img src="images/collection/1-2.jpg" alt="">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-6 col-custom order-1 order-md-2">
                    <div class="collection-content">

                        <div class="section-title text-left">
                            <span class="section-title-1">Flowers for the</span>
                            <h3 class="section-title-3 pb-0">Wedding day</h3>
                        </div>

                        <div class="desc-content">
                            <p>A wedding day is a beautiful celebration of love, dreams, and new beginnings. It's a day when two souls unite, surrounded by the warmth and blessings of family and friends. we delve into the enchanting world of wedding flowers and explore how our online flower shop system can help you create a picture-perfect wedding day filled with beauty, romance, and unforgettable memories.</p>
                        </div>

                        <a href="weddings.php" class="btn flower-button secondary-btn rounded-0">Our Collection</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
 
<?php @include 'footer.php'; ?>

<a class="scroll-to-top" href="#">
    <i class="lnr lnr-arrow-up"></i>
</a>

<script src="js/vendor/jquery-3.6.0.min.js"></script>
<script src="js/vendor/jquery-migrate-3.3.2.min.js"></script>
<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="js/vendor/bootstrap.bundle.min.js"></script>
<script src="js/plugins/swiper-bundle.min.js"></script>
<script src="js/plugins/nice-select.min.js"></script>
<script src="js/plugins/jquery.ajaxchimp.min.js"></script>
<script src="js/plugins/jquery-ui.min.js"></script>
<script src="js/plugins/jquery.countdown.min.js"></script>
<script src="js/plugins/jquery.magnific-popup.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>