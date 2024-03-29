<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $host = "localhost";
    $dbname = "job";
    $username = "root";
    $password = "";

    // Create a PDO instance
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact_number = $_POST["contact_number"];
    $passedout_year = $_POST["passedout_year"];
    $category = $_POST["category"];
    $Address = $_POST["Address"];
    $cover_letter = $_POST["cover_letter"];

    // Process the uploaded resume file
    $fileInputName = "resume";

    if (isset($_FILES[$fileInputName])) {
        $target_dir = "";
        $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($fileType != "pdf") {
            echo '<script>alert("Only PDF files are allowed."); window.location.href = "form.php";</script>';
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo '<script>alert("Sorry, your file was not uploaded."); window.location.href = "form.php";</script>';
        } else {
            if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
                echo '<script>alert("The file ' . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . ' has been uploaded."); window.location.href = "job-list.php";</script>';
            } else {
                echo '<script>alert("No file uploaded."); window.location.href = "form.php";</script>';
            }
        }
    }

    // Insert data into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO job_applications (name, email, contact_number, category, passedout_year, Address, cover_letter, resume_path) VALUES (:name, :email, :contact_number, :category, :passedout_year, :Address, :cover_letter, :resume_path)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':passedout_year', $passedout_year);
        $stmt->bindParam(':Address', $Address);
        $stmt->bindParam(':cover_letter', $cover_letter);
        $stmt->bindParam(':resume_path', $target_file);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
} else {
    echo "Invalid request";
}
?>
