<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="main-header-area">

        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
                        <div class="header-logo d-flex align-items-center">
                            <a href="home.php">
                                <img class="img-full" src="./images/305847254_517590973705462_1591856429199042771_n.jpg" alt="Header Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-flex justify-content-center col-custom">
                        <nav class="main-nav d-none d-lg-flex"> 
                            <ul class="nav">
                                <li>
                                    <a href="home.php">
                                        <span class="menu-text"> Home </span>
                                    </a>
                                </li>
                               
                                <li>
                                    <a href="about_us.php">
                                        <span class="menu-text"> About Us</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="menu-text"> Shop </span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li><a href="orders.php">Orders</a></li>
                                        <li><a href="special_offers.php">Special offers</a></li>
                                        <li><a href="flower_arrangements.php">Flower arrangements</a></li>
                                        <li><a href="flower_bunches.php">Flower bunches</a></li>
                                        <li><a href="gift_boxes.php">Gift boxes</a></li>
                                        <li><a href="individual_flower.php">Individual flowers</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="menu-text"> Occasions </span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <li><a href="birthday.php"> Birthday </a></li>
                                        <li><a href="bridal_bouquets.php"> Bridal bouquets </a></li>
                                        <li><a href="weddings.php"> Weddings </a></li>
                                        <li><a href="special_days.php"> Special Days</a></li>
                                    </ul>
                                </li>
                               
                                <li>
                                    <a href="contact-us.php">
                                        <span class="menu-text">Contact Us</span>
                                    </a>
                                </li> 

                                <li>
                                    <a href="my_account.php">
                                        <span class="menu-text"> My Account </span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        <div class="account-box">
                                            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                                            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                                            <a href="logout.php" class="delete-btn">logout</a>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-lg-2 col-md-6 col-6 col-custom">
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                            
                                <li class="sidemenu-wrap">
                                    <a href="search_page.php"><i class="fa fa-search"></i> </a>
                                </li>


                                <?php
                                    $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                                    $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
                                ?>
 

                                <li class="miniheart-wrap">
                                    <a href="wishlist.php" class="miniheart-btn toolbar-btn">
                                        <i class="fa fa-heart"></i>
                                        <span>(<?php echo $wishlist_num_rows; ?>)</span>
                                    </a>
                                </li>


                                <?php
                                    $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                                    $cart_num_rows = mysqli_num_rows($select_cart_count);
                                ?>


                                <li class="minicart-wrap">
                                    <a href="cart.php" class="minicart-btn toolbar-btn">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>(<?php echo $cart_num_rows; ?>)</span>
                                    </a>
                                </li>

                                <li class="account-menu-wrap d-none d-lg-flex">
                                    <a href="#" class="off-canvas-menu-btn">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                                
                                <li class="mobile-menu-btn d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper" id="mobileMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>

                <div class="off-canvas-inner">

                    <div class="search-box-offcanvas">

                        <li class="sidemenu-wrap">
                            <a href="search_page.php"><i class="fa fa-search"></i> </a>
                        </li>

                    </div>
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li><a href="home.php"> Home </a>
                                </li>

                                <li><a href="about_us.php"> About Us </a> 
                                </li>

                                <li class="menu-item-has-children "><a href="#">Shop</a>
                                    <ul class="dropdown">
                                        <li><a href="orders.php">Orders</a></li>
                                        <li><a href="special_offers.php">Special offers</a></li>
                                        <li><a href="flower_arrangements.php">Flower arrangements</a></li>
                                        <li><a href="flower_bunches.php">Flower bunches</a></li>
                                        <li><a href="gift_boxes.php">Gift boxes</a></li>
                                        <li><a href="individual_flower.php">Individual flowers</a></li>
                                    </ul>
                                </li>

                                

                                <li class="menu-item-has-children "><a href="#">Occasions</a>
                                    <ul class="dropdown">
                                        <li><a href="birthday.php"> Birthday </a></li>
                                        <li><a href="bridal_bouquets.php"> Bridal bouquets </a></li>
                                        <li><a href="weddings.php"> Weddings </a></li>
                                        <li><a href="special_days.php"> Special Days</a></li>
                                    </ul>
                                </li>
                                
                                <li><a href="contact-us.php">Contact Us</a></li>

                                <li class="menu-item-has-children "><a href="#">My Account</a>
                                    <ul class="dropdown">
                                        <li><a href="login.php"> Login </a></li>
                                        <li><a href="register.php"> Register </a></li>
                                        <li><a href="logout.php" class="delete-btn">logout</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    
                    <div class="offcanvas-widget-area">
                        
                        <div class="top-info-wrap text-left text-black">
                            <ul class="address-info">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    077 2395 190
                                </li>

                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:apiflora039@gmail.com" target="_blank"> apiflora039@gmail.com </a>
                                </li>

                            </ul>
                            <div class="widget-social">
                                <a class="facebook-color-bg" title="Facebook" href="https://www.facebook.com/Apifloralk/"><i class="fa fa-facebook"></i></a>
                                <a class="instagram-color-bg" title="Instagram" href="https://www.instagram.com/api_flora.lk/"><i class="fa fa-instagram"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- mobile menu end -->
        <!-- side about us menu start -->
        <aside class="off-canvas-menu-wrapper" id="sideMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="off-canvas-inner">
                    <div class="btn-close-off-canvas">
                        <i class="fa fa-times"></i>
                    </div>

                    <div class="offcanvas-widget-area">
                        <ul class="menu-top-menu">
                            <li><a href="about_us.php">About Us</a></li>
                        </ul>
                        
                        <p class="desc-content">Welcome to API Flora, your premier destination for exquisite flowers and stunning floral arrangements. With a passion for beauty and a commitment to exceptional customer service, we strive to create memorable experiences through the language of flowers..
                            <br>Founded by Sumudu Jayarathne in 2017, API Flora has blossomed into a renowned floral destination, serving customers with a wide array of enchanting blooms and personalized floral designs. What began as a small family-owned business has grown into a thriving floral haven, dedicated to bringing joy and elegance into the lives of our valued customers.
                        </p>
                        
                        <div class="top-info-wrap text-left text-black">
                            <ul class="address-info">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    077 2395 190
                                </li>

                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:apiflora039@gmail.com" target="_blank"> apiflora039@gmail.com </a>
                                </li>

                            </ul>
                            <div class="widget-social">
                                <a class="facebook-color-bg" title="Facebook" href="https://www.facebook.com/Apifloralk/"><i class="fa fa-facebook"></i></a>
                                <a class="instagram-color-bg" title="Instagram" href="https://www.instagram.com/api_flora.lk/"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </aside>
       <!-- side about us menu end -->

</header>