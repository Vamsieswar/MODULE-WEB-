<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION["Name"] = $row["name"];
      $_SESSION["email"] = $row["email"];
      header('location:index.html');
   }else {





      echo "<script type='text/javascript'>alert('$message');window.location.href='index.html';</script>";
  //	$_SESSION["firstname"] = $name;
  
      $_SESSION["Name"] = $row["name"];
      $_SESSION["email"] = $row["email"];
      
          } 
   
   
  

} else{
   $message[] = 'incorrect email or password!';
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="procss/style.css">

</head>
<body>
   
<div class="form-container">


   <form action="" method="post" enctype="multipart/form-data">

      <h3>login now</h3>
   
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
         <img src="Screenshot 2023-12-15 150939.png" alt="Paris" class="full" 
      style="display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top:-75px;
  width: 100%;">
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn" style="background-color:#00B074;color:black">
      <p>don't have an account? <a href="register.php">Signup?</a></p>
   </form>

</div>

</body>
</html>