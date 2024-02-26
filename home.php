<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php'); 
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>

<!doctype html>
<html class="no-js" lang="en">

<head> 

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> API Flora Online Flower Shop </title>
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

<!-- home intro start -->
<div class="intro11-slider-wrap section-2">
        <div class="intro11-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="intro11-section swiper-slide slide-5 slide-bg-1 bg-position">
                    <div class="intro11-content-2 text-center">
                        <h1 class="different-title"> Welcome</h1>
                        <h2 class="title text-white">Flower Partner of Your Life</h2>
                        <a href="special_offers.php" class="btn flower-button  secondary-btn theme-color rounded-0">Our Collection</a>
                    </div>
                </div>
            </div>
        </div>
</div> 
<!-- home intro end -->

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

    <div class="section-title text-center mb-30">
        <h3 class="section-title-3">Special Offers</h3>
    </div>
    <div class="banner-area mt-text-3">
        <div class="container custom-area">
            <div class="row">
                <div class="col-lg-6 col-custom">
                    <div class="single-banner hover-style mb-30">
                        <div class="banner-img">
                            <a href="special_offers.php">
                                <img src="images/banner/1-1.jpg" alt="">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-custom">
                    <div class="single-banner hover-style mb-30">
                        <div class="banner-img">
                            <a href="special_offers.php">
                                <img src="images/banner/1-3.jpg" alt="">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
    

    <div class="blog-post-area mt-text-3">
        <div class="container custom-area">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30">
                        <h3 class="section-title-3">Our Latest Posts</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-custom mb-30">
                    <div class="blog-lst">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a class="d-block" href="weddings.php">
                                    <img src="images/blog/blog1.jpg" alt="Blog Image" class="w-100">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-text">
                                    <h4><a href="weddings.php">The Blossom Diaries</a></h4>
                                    <div class="blog-post-info">
                                        <span><a href="#">By admin</a></span>
                                        <span>July 3, 2023</span>
                                    </div>
                                    <p>At our online flower shop, we understand that flowers have the remarkable ability to convey emotions and create connections. In this blog, we celebrate the enchanting world of flowers while sharing a collection of cute and heartfelt messages that can accompany these exquisite blooms. Join us as we explore the beauty of flowers and inspire you to add a touch of sentiment to your floral gifts.</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 col-custom mb-30">
                    <div class="blog-lst">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a class="d-block" href="weddings.php">
                                    <img src="images/blog/blog3.jpg" alt="Blog Image" class="w-100">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-text">
                                    <h4><a href="weddings.php">Flower Festivities</a></h4>
                                    <div class="blog-post-info">
                                        <span><a href="#">By admin</a></span>
                                        <span>July 05, 2023</span>
                                    </div>
                                    <p>Weddings:<br> Love in Full Bloom
                                        Weddings are a celebration of love and the beginning of a beautiful journey together. Dive into the world of bridal bouquets, centerpieces, and breathtaking floral installations. From traditional white roses to bohemian wildflowers, explore the endless possibilities for creating a dreamy atmosphere that reflects the couple's style and romance. Learn about popular wedding flower trends, seasonal blooms, and expert tips for choosing the perfect floral arrangements for the big day. .</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 col-custom mb-30">
                    <div class="blog-lst">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a class="d-block" href="special_days.php">
                                    <img src="images/blog/blog2.jpg" alt="Blog Image" class="w-100">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-text">
                                    <h4><a href="special_days.php">Just Because</a></h4>
                                    <div class="blog-post-info">
                                        <span><a href="#">By admin</a></span>
                                        <span>August 20, 2023</span>
                                    </div>
                                    <p> Spontaneous Surprises
                                        Flowers don't always need a specific occasion to bring joy. Surprise your loved ones "just because" with a bouquet and a playful message like "No special reason, just wanted to see you smile" or "Sending these flowers to brighten your day because you deserve it .</p>
                                </div>
                            </div>
                        </div>
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