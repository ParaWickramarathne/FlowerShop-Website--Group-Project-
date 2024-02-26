<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};



if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $category = mysqli_real_escape_string($conn, $_POST['category']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;

   $offer = 0;

   if (empty($_POST['Special_Offer'])) {
      $offer = 0;
    } else {
      $offer = 1;
    }

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, image, category, offer) VALUES('$name', '$details', '$price', '$image', '$category', '$offer')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'product added successfully!';
         }
      }
   }
 
}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];

   $stmt = $conn->prepare('DELETE FROM `products` WHERE id = ?');
   $stmt->bind_param("s",$delete_id);
   $stmt->execute();

   $stmt = $conn->prepare('DELETE FROM `wishlist` WHERE pid = ?');
   $stmt->bind_param("s",$delete_id);
   $stmt->execute();

   $stmt = $conn->prepare('DELETE FROM `cart` WHERE pid = ?');
   $stmt->bind_param("s",$delete_id);
   $stmt->execute();

   $stmt->close();
   
   header('location:admin_product_added.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>API Flora Admin Panel </title>
   <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="enter product name">
         <select name="category" class="box" required>
            <option value="" selected disabled>select category</option>
               <!-- <option value="Best Seller">Best Seller</option> -->
               <option value="Flower Arrangements">Flower Arrangements</option>
               <option value="Flower Bunches">Flower Bunches</option>
               <option value="Gift Box">Gift Box</option>
               <option value="Individual Flowers">Individual Flowers</option>
               <option value="Birthday">Birthday</option>
               <option value="Bridal Bouquet">Bridal Bouquet</option>
               <option value="Weddings">Weddings</option>
               <option value="Special Days">Special Days</option>
         </select>

         </div>
            <div class="inputBox">
            <input type="number" min="0" name="price" class="box" required placeholder="enter product price">
            <label for="offer">Special Offer</label>

            <input type="checkbox" name="Special_Offer" id="offer" class="box">
            <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
      </div>
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="add product" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <div class="price">Rs.<?php echo $fetch_products['price']; ?>/=</div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_product_added.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>


<script src="js/script.js"></script>

</body>
</html>