<?php
// Start session


// Check if notification has been shown before
if (!isset($_SESSION['notification_shown']) || !$_SESSION['notification_shown']) {
    // Establish database connection (modify these parameters as per your database configuration)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "job";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch notifications
    //$sql = "SELECT COUNT(*) AS status FROM job_applications WHERE status = 'Rejected'";
    $sql = "SELECT COUNT(*) AS status FROM job_applications WHERE (status = 'Accepted' OR status = 'Rejected') AND sid = '0'";

    $result = $conn->query($sql);

    $status = 0; // Default notification count

    if ($result->num_rows > 0) {
        // Fetch notification count
        $row = $result->fetch_assoc();
        $status = $row["status"];
    }

    // Close connection
    $conn->close();

    // Set session variable to indicate that notification has been shown
    $_SESSION['notification_shown'] = true;
} else {
    // If notification has been shown before, set default status
    $status = 0;
}
?>
<?php

include 'config.php';
session_start();
$user_id = $_SESSION['id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HUBSPOT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css\style.css" rel="stylesheet">
   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="procss/style.css"> -->


   <style>
      .notification-icon {
    position: relative;
    display: inline-block;
    width: 50px;
    left:-14px;
    top:7px;
    height: 50px;
    background-color: #ccc;
    border-radius: 50%;
    text-align: center;
    line-height: 50px;
    font-size: 20px;
  }

  .notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    height: 20px;
    background-color: red;
    border-radius: 50%;
    color: white;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
                        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

                  :root{
                     --blue:#3498db;
                     --dark-blue:#2980b9;
                     --red:;
                     --dark-red:skyblue;
                     --black:#333;
                     --white:#fff;
                     --light-bg:#eee;
                     --box-shadow:0 5px 10px rgba(0,0,0,.1);
                  }
                        *::-webkit-scrollbar{
                     width: 10px;
                  }

                  *::-webkit-scrollbar-track{
                     background-color: transparent;
                  }

                  *::-webkit-scrollbar-thumb{
                     background-color: var(--blue);
                  }

                  .btn,
                  .delete-btn{
                     width: 100%;
                     border-radius: 5px;
                     padding:10px 30px;
                     color:black;
                     display: block;
                     text-align: center;
                     cursor: pointer;
                     font-size: 20px;
                     margin-top: 10px;
                  }


                  .delete-btn{
                     background-color: var(--red);
                  }

                  .delete-btn:hover{
                     background-color: var(--dark-red);
                  }

                  .message{
                     margin:10px 0;
                     width: 100%;
                     border-radius: 5px;
                     padding:10px;
                     text-align: center;
                     background-color: var(--red);
                     color:var(--white);
                     font-size: 20px;
                  }

                  .form-container{
                     min-height: 100vh;
                     background-color: var(--light-bg);
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     padding:20px;
                  }

                  .form-container form{
                     padding:20px;
                     background-color: var(--white);
                     box-shadow: var(--box-shadow);
                     text-align: center;
                     width: 500px;
                     border-radius: 5px;
                  }

                  .form-container form h3{
                     margin-bottom: 10px;
                     font-size: 30px;
                     color:var(--black);
                     text-transform: uppercase;
                  }

                  .form-container form .box{
                     width: 100%;
                     border-radius: 5px;
                     padding:12px 14px;
                     font-size: 18px;
                     color:var(--black);
                     margin:10px 0;
                     background-color: var(--light-bg);
                  }

                  .form-container form p{
                     margin-top: 15px;
                     font-size: 20px;
                     color:var(--black);
                  }

                  .form-container form p a{
                     color:var(--red);
                  }

                  .form-container form p a:hover{
                     text-decoration: underline;
                  }

                  .container{
                     min-height: 100vh;
                     background-color: var(--light-bg);
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     padding:20px;
                  }

                  .container .profile{
                     padding:20px;
                     background-color: var(--white);
                     box-shadow: var(--box-shadow);
                     text-align: center;
                     width: 400px;
                     border-radius: 5px;
                  }

                  .container .profile img{
                     height: 150px;
                     width: 150px;
                     object-fit: cover;
                     margin-bottom: 5px;
                  }

                  .container .profile h3{
                     margin:5px 0;
                     font-size: 20px;
                     color:var(--black);
                  }

                  .container .profile p{
                     margin-top: 20px;
                     color:var(--black);
                     font-size: 20px;
                  }

                  .container .profile p a{
                     color:var(--red);
                  }

                  .container .profile p a:hover{
                     text-decoration: underline;
                  }

                  .update-profile{
                     min-height: 100vh;
                     background-color: var(--light-bg);
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     padding:20px;
                  }

                  .update-profile form{
                     padding:20px;
                     background-color: var(--white);
                     box-shadow: var(--box-shadow);
                     text-align: center;
                     width: 700px;
                     text-align: center;
                     border-radius: 5px;
                  }

                  .update-profile form img{
                     height: 200px;
                     width: 200p;
                     border-radius: 50%;
                     object-fit: cover;
                     margin-bottom: 5px;
                  }

                  .update-profile form .flex{
                     display: flex;
                     justify-content: space-between;
                     margin-bottom: 20px;
                     gap:15px;
                  }

                  .update-profile form .flex .inputBox{
                     width: 49%;
                  }

                  .update-profile form .flex .inputBox span{
                     text-align: left;
                     display: block;
                     margin-top: 15px;
                     font-size: 17px;
                     color:var(--black);
                  }

                  .update-profile form .flex .inputBox .box{
                     width: 100%;
                     border-radius: 5px;
                     background-color: var(--light-bg);
                     padding:12px 14px;
                     font-size: 17px;
                     color:var(--black);
                     margin-top: 10px;
                  }

                  @media (max-width:650px){
                     .update-profile form .flex{
                        flex-wrap: wrap;
                        gap:0;
                     }
                     .update-profile form .flex .inputBox{
                        width: 100%;
                     }
                  }
      </style>
</head>
<body>
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">HUBSPOT</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item">Job List</a>
                            <!-- <a href="job-detail.html" class="dropdown-item">Job Detail</a> -->
                            <a href="form.php" class="dropdown-item">Job Apply</a>
                            <!-- <a href="testimonial.html" class="dropdown-item">Testimonial</a> -->
                        </div>
                    </div>
                    <a href="history.php" class="nav-item nav-link">History</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <a href="history_status.php" class="notification-link">
    <div class="notification-icon">
        <i class="fas fa-bell"></i>
        <?php if ($status > 0): ?>
            <span class="notification-badge"><?php echo $status; ?></span>
        <?php endif; ?>
    </div>
</a>

<?php
// Unset session variable when page is refreshed
unset($_SESSION['notification_shown']);
?>
                </div>
                <div class="nav-item dropdown">
                    <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block" style="color: #ffffff;" data-bs-toggle="dropdown">PROFILE</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="update_profile.php" class="dropdown-item">Edit</a>
                        <a href="intro.html" class="dropdown-item">Logout</a>
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </nav>

           
        <!-- Navbar End -->
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/testimonial-3"  style="">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
      <a href="index.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>