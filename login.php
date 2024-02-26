<?php  

@include 'config.php';

session_start();  
 
if(isset($_POST['submit'])){ 

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING); 
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING); 
   $pass = mysqli_real_escape_string($conn, md5($filter_pass)); 

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 

   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_dashboard.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>API Flora - Login </title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
      <link rel="stylesheet" href="css/admin_style.css">
      
      <!-- background image -->
      <style>
         body{
            background-image: url(login_background.png);
            background-size: cover;
         }
      </style>

</head>

<body>

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

    <section class="form-container">

        <form action="" method="post">    
            <h3>login now</h3>
            <input type="email" name="email" class="box" placeholder="enter your email" required>
            <input type="password" name="pass" class="box" placeholder="enter your password" required>
            <input type="submit" class="btn" name="submit" value="login now">
            <p>don't have an account?<a href="register.php">register now</a></p>
        </form>
        
    </section>

    </body>
</html>


    
