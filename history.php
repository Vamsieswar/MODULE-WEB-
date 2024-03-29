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
session_start();
error_reporting(0);


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
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->

		<!-- CSS here -->
           
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
        
        /*    
        th {
            background-color: white;
        }
        tr:nth-child(odd) {
            background-color: grey;
        }
        th, td {
            padding: 0.5rem;
        }
        td:hover {
            background-color: lightsalmon;
        }
        
        .paginate_button {
            border-radius: 0 !important;
        } */
        
            /* CSS */
            #example {
        
        border-collapse: collapse;
        width: 100%;
        }

        #example td, #example th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #example tr:nth-child(even){background-color: #f2f2f2;}

        #example tr:hover {background-color: #ddd;}

        #example th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #00B074;
        color: white;
        }
        .button-10 {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 6px 14px;
            font-family: -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
            border-radius: 6px;
            border: none;
        
            color: #fff;
            background: linear-gradient(180deg, #4B91F7 0%, #367AF6 100%);
            background-origin: border-box;
            box-shadow: 0px 0.5px 1.5px rgba(54, 122, 246, 0.25), inset 0px 0.8px 0px -0.25px rgba(255, 255, 255, 0.2);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }
        
        .button-10:focus {
            box-shadow: inset 0px 0.8px 0px -0.25px rgba(255, 255, 255, 0.2), 0px 0.5px 1.5px rgba(54, 122, 246, 0.25), 0px 0px 0px 3.5px rgba(58, 108, 217, 0.5);
            outline: 0;
        }   
 </style>
   </head>

   <body>
            <!-- Navbar Start -->
            <div class="container-xxl bg-white p-0">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">HUBSPOT</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
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
                    <a href="history.php" class="nav-item nav-link active">History</a>
                    <a href="contact.php" class="nav-item nav-link">CONTACT</a>
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
   
    <main>

    <table id="example" class="display" cellspacing="0" style="margin-top: 45px;
    font-size: 16px;text-align: center;" width="100%">
        <thead style="background-color: grey;">
            <tr>
                
                <th>Name</th>
                <th>Email</th>
               <th>Contact</th>
               <th>passedout_year</th>
               <th>Resume</th>
               <th>category</th>
               <th>Address</th>
               <th>Status</th>
              

                
            </tr>
        </thead>

 
        <tbody>
        <?php
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'job';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION["Name"];

// Query to select all images from the table
$sql = "SELECT * FROM job_applications WHERE name='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Retrieve the data
        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['contact_number'];
        $passedout_year = $row['passedout_year'];
        $resume = $row['resume_path'];
        $category = $row['category'];
        $address = $row['address'];
        $status = $row['status'];

        // Generate the HTML for each row with Bootstrap card styling
        echo '<tr>
            <td>' . $name . '</td>
            <td>' .  $email . '</td>
            <td>' .   $contact . '</td>
            <td>' .  $passedout_year . '</td>
            <td><a href="' . $resume . '" download="' . basename($resume) . '">Download</a></td>
            <td>' .  $category . '</td>
            <td>' . $address . '</td>
            <td>' . $status . '</td>
        </tr>';
    }
}

// Close the database connection
$conn->close();
?>

          
          

          
           
      </tbody>
   </table>
        
    <!-- partial -->
 
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            select: false,
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }]
        });

        $('#example tbody').on('click', 'tr', function() {
            alert(table.row(this).data()[0]);
        });
    });
</script>                                                                                                                                                                                                                                                                

    </main>
    
    </div>

    </body>
   
</html>