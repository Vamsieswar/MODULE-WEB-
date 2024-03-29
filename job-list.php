<?php
// Start session
session_start();

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

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
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
    .page-header {
        background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url(images/SLP-Recruitment-Graphic.png) center center no-repeat;
        background-size: cover;
    }
    </style>
<body>



      



    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">HUBSPOT</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item active">Job List</a>
                            <a href="job-detail.html" class="dropdown-item">Job Detail</a>
                            <a href="form.php" class="dropdown-item">Job Apply</a>
                            <!-- <a href="testimonial.html" class="dropdown-item">Testimonial</a> -->

                        </div>
                    </div>
                    <a href="history.php" class="nav-item nav-link">History</a>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                            
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
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Job List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Featured</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Full Time</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <h6 class="mt-n1 mb-0">Part Time</h6>
                            </a>
                        </li>
                        <div class="search-bar">
                            <span class="search-icon" style="margin-left: 910px;">&#128269;</span>
                            <input type="text" id="search-input" class="search-input" placeholder="Search...">
                        </div>
                    </ul>



                    <?php
                        //$sql = mysqli_query($conn, "SELECT DISTINCT * FROM tblcategory");
                        $sql = mysqli_query($conn, "SELECT * FROM tblcategory");
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                    
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="Screenshot 2023-12-15 150939.png" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3"><?php echo $row['CategoryName']; ?> (<?php echo $row['vancancy']; ?>)</h5>
                                            <?php echo $row['description']; ?>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row['location']; ?></span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $row['lpa']; ?>LPA</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <!-- <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a> -->
                                            <a class="btn btn-primary" href="form.php">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $row['date']; ?> </small>
                                    </div>
                                </div>
                            </div>
                            
                            
                           
                            <!-- <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a> -->
                        </div>

                    </div>

                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


       


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    

    <script>
            $(document).ready(function() {
                $('#search-input').on('input', function() {
                    var searchText = $(this).val().toLowerCase();
                    $('.job-item').each(function() {
                        var jobName = $(this).find('.mb-3').text().toLowerCase();
                        if (jobName.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
</body>

</html>