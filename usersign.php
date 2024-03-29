<?php
 $servername = "localhost";

    $username = "root";

    $password = "";

    $dbname = "job"; 
	
	$message = "Register successful";
	
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	 $Name = $_POST['name'];

     $email = $_POST['email'];

     $number = $_POST['number'];

     $password = $_POST['password'];
     

     $sql = "INSERT INTO user_form(name, email,phone_number,password) VALUES('$Name','$email','$number','$password')";
	 

if ($conn->query($sql) === TRUE) {
  
  echo "<script type='text/javascript'>alert('$message');window.location.href='hubspotlogin.php';</script>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>