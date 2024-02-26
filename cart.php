<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

// if(isset($_POST['update_quantity'])){
//     $cart_id = $_POST['cart_id'];
//     $cart_quantity = $_POST['cart_quantity'];
//     echo $cart_id.'<br>';
//     echo $cart_quantity.'<br>';
//     mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
//     // $message[] = 'cart quantity updated!';
// }

if(isset($_POST['update_quantity'])){
    
    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize and validate input
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    $cart_quantity = mysqli_real_escape_string($conn, $_POST['cart_quantity']);

    // Debugging: Output the values to verify they are correct
    // echo $cart_id.'<br>';
    // echo $cart_quantity.'<br>';

    // Update the quantity in the cart
    $query = "UPDATE `cart` SET `quantity` = '$cart_quantity' WHERE `id` = '$cart_id'";
    if (mysqli_query($conn, $query)) {
        // echo "Cart quantity updated!";
    } else {
        echo "Error: " . mysqli_error($conn);
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
                        <h1>SHOPING  CART</h1>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li style="color:red;">Shoping cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Breadcrumb Area End Here -->

<!-- cart main wrapper start -->
    <div class="cart-main-wrapper mt-no-text">
        <div class="container custom-area">

            <div class="row">
                <div class="col-lg-12 col-custom">

                    <!-- Cart Table Area start -->
                    <div class="cart-table table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-update"> Update </th>
                                    <th class="pro-subtotal">Sub total</th>
                                    <th class="pro-remove">Remove</th> 
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $grand_total = 0;
                            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                            if(mysqli_num_rows($select_cart) > 0){
                                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        ?>
                                <tr>
                                    <form method="post" >

                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="Product" /></a></td>
                                    <td class="pro-title"><?php echo $fetch_cart['name']; ?></td>
                                    <td class="pro-price">Rs.<?php echo $fetch_cart['price']; ?>/=</td>

                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="<?php echo $fetch_cart['id']; ?>" name="cart_id" hidden>
                                                <input type="number"class="cart-plus-minus-box quantity_modification" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td type="submit" class="pro-update"><button type="submit" class="btn flower-button dark-btn" name="update_quantity">Update</button></td>
                                   
                                    </form>
                                    <td class="pro-subtotal"> <span>Rs.<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/=</span></td>
                                    <td class="pro-remove"><a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>"class="lnr lnr-trash" onclick="return confirm('delete this from cart?');"></a></td>
                                    

                                    <?php
                                        $grand_total += $sub_total;
                                            }
                                        }else{
                                            echo '<p class="empty">your cart is empty</p>';
                                        } 
                                        ?> 
                                        </tr>

                            </tbody>
                        </table>

                    </div>
                    <!-- Cart Table Area end -->

                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 ml-auto col-custom">

                    <!-- Cart Calculation Area start -->

                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Cart Total</h3>
                                <div class="table-responsive">

                                    <table class="table">

                                        <?php
                                            $grand_total = 0;
                                            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                                            if(mysqli_num_rows($select_cart) > 0){
                                                $final_total = 0;
                                                $final_grand_total = 0;
                                                while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
                                                    $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
                                                    $final_total += $sub_total;
                                                    $grand_total += $sub_total;
                                                    $final_grand_total += $grand_total;
                                                }
                                        ?>

                                        <tr>
                                        <td class="pro-subtotal">Sub total : <span>Rs.<?php echo $final_total; ?>/=</span></td>
                                        </tr>

                                        
                                        <tr class="total">
                                            <td>Total : <span>Rs.<?php echo $grand_total; ?>/=</span></td>
                                        </tr>

                                        <?php
                                            $grand_total += $sub_total;
                                            }else{
                                                echo '<p class="empty">your cart is empty</p>';
                                            }
                                        ?>

                                    </table>

                                </div>
                            </div>

                            <a href="home.php" class="btn flower-button primary-btn rounded-0 black-btn w-100">Continue Shopping</a>
                            <a href="checkout.php" class="btn flower-button primary-btn rounded-0 black-btn w-100  <?php echo ($grand_total > 1)?'':'disabled' ?>">Proceed To Checkout</a>
                        </div>

                    <!-- Cart Calculation Area end -->

                </div>
            </div>

        </div>
    </div>
<!-- cart main wrapper end -->


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