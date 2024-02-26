<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address1']);

    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        // $message[] = 'order placed successfully!';
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

    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h1>CHECKOUT</h1>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li style="color:red;">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->


    <!-- Checkout Area Start Here -->

    <div class="checkout-area mt-no-text">
        <div class="container custom-container">

            <div class="col-lg-6 col-12 col-custom">
                <form action="" method="POST">
                    <div class="checkbox-form">
                        <h3>Place your order</h3>
                        <div class="row">

                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>Your name : <span class="required"></span></label>
                                    <input placeholder="enter your name" type="text" name="name">
                                </div>
                            </div>

                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>Phone number : <span class="required"></span></label>
                                    <input placeholder="enter your phone number" type="text" name="number">
                                </div>
                            </div>

                            <div class="col-md-12 col-custom">
                                <div class="checkout-form-list">
                                    <label>Address : <span class="required"></span></label>
                                    <input placeholder="enter address line 01" type="text" name="address1">
                                </div>
                            </div>


                            <div class="col-md-12 col-custom">
                                <div class="checkout-form-list">
                                    <label>Town / City : <span class="required"></span></label>
                                    <input placeholder="town / city name" type="text" name="city">
                                </div>
                            </div>

                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>County : <span class="required"></span></label>
                                    <input placeholder="country name" type="text" name="country">
                                </div>
                            </div>

                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>Postal code : <span class="required"></span></label>
                                    <input placeholder="enter postal code" type="text" name="pin_code">
                                </div>
                            </div>

                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>Email Address : <span class="required"></span></label>
                                    <input placeholder="enter your email" type="email" name="email">
                                </div>
                            </div>

                            <div class="country-select clearfix">
                                <label>Payment method<span class="required" ></span></label>
                                <select class="myniceselect nice-select wide rounded-0" name="method">
                                    <option data-display="Cash on delivery">Cash on delivery</option>
                                </select>
                            </div>

                        </div>

                    </div>

            </div>

            <div class="col-lg-6 col-12 col-custom">
                <div class="your-order">
                    <h3>Order Details</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                        <thead>
                                <tr>
                                    <th class="cart-product-name">Products</th>
                                    <th class="cart-product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $grand_total = 0;
                            $subtotal = 0;
                            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                            if (mysqli_num_rows($select_cart) > 0) {
                                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                                    $subtotal += $total_price;
                                    $grand_total += $total_price;
                            ?>
                                    <tr class="cart_item">
                                    <td class="cart-product-name"> 
                                    <?php echo  $fetch_cart['name'] ?>
                                    </td>
                                    <td class="cart-product-total text-center"><?php echo 'Rs.' . $fetch_cart['price'] . '/-' . ' x ' . $fetch_cart['quantity']  ?></td>
                                </tr>
                            <?php
                                }
                            } else {
                                echo '<p class="empty">your cart is empty</p>';
                            }
                            ?>
                            
                            </tbody>

                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal :</th>
                                    <td class="text-center"><span class="amount">Rs.<?php echo ($subtotal == null ? "0" : $subtotal)?></span></td>
                                </tr>

                                <tr class="order-total">
                                    <th>Order Total :</th>
                                    <td class="text-center"><strong><span class="amount">Rs.<?php echo $grand_total ?></span></strong></td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>



                    <input type="submit" name="order" value="Place your order" class="btn flower-button secondary-btn black-color rounded-0 w-100">


                </div>
            </div>

            </form>

        </div>
    </div>

    <!-- Checkout Area End Here -->


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