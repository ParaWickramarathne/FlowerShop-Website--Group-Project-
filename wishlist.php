<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + '$product_quantity' WHERE user_id = '$user_id' AND pid = '$product_id'") or die('query failed'); 
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        // $message[] = 'product added to cart';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
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
                        <h1>WISH LIST</h1>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li style="color:red;">Wish List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
    <!-- Breadcrumb Area End Here -->

<!-- Wishlist main wrapper start -->
<div class="wishlist-main-wrapper mt-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Wishlist Table Area start -->
                    <div class="wishlist-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-cart">Add to Cart</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $grand_total = 0;
                                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                                if(mysqli_num_rows($select_wishlist) > 0){
                                    while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
                            ?>

                                <tr>
                                    <form method="POST">
                                    <td class="pro-thumbnail"><img class="img-fluid" src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="Product" /></td>
                                    <td class="pro-title"><?php echo $fetch_wishlist['name']; ?></td>
                                    <td class="pro-price">Rs.<?php echo $fetch_wishlist['price']; ?>/=</td>
                                    
                                    <input name="product_id" type="text" value="<?php echo $fetch_wishlist['id']; ?>" hidden />
                                    <input name="product_name" type="text" value="<?php echo $fetch_wishlist['name']; ?>" hidden />
                                    <input name="product_price" type="text" value="<?php echo $fetch_wishlist['price']; ?>" hidden />
                                    <input name="product_image" type="text" value="<?php echo $fetch_wishlist['image']; ?>" hidden />

                                    <td class="pro-cart"><input type="submit" value="add to cart" name="add_to_cart" class="btn product-cart button-icon flower-button dark-btn"></td>
                                    
                                    <td class="pro-remove"><a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" onclick="return confirm('delete this from wishlist?');"><i class="lnr lnr-trash"></i></a></td>
                                    </form>
                                </tr>
                                
                                <?php
                                    $grand_total += $fetch_wishlist['price'];
                                }
                            }else{
                                echo '<p class="empty">your wishlist is empty</p>';
                            }
                            ?>
                        </tbody>    

                        </table>
                    </div>
                    <!-- Wishlist Table Area end -->
                </div>
            </div>
        </div>
    </div>
<!-- Wishlist main wrapper end -->


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