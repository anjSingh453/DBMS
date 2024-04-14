<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit(); // Add an exit here to prevent further execution of the script
}

// Get the patient ID, name, and email from the URL parameters
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['email'])) {
    $patient_id = $_GET['id'];
    $patient_name = $_GET['name'];
    $patient_email = $_GET['email'];
} else {
    // Handle the case when the parameters are not set
    // Redirect or display an error message
    echo "Error: Patient details not provided.";
    exit(); // Add an exit here to prevent further execution of the script
}

//import database
include("../connection.php");



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/healthlogo.png" type="image/x-icon">    
    <title>Upload Clinical Report</title>
</head>
<body>
    <div class="container">
        <div class="menu">
            <!-- Menu content -->
        </div>
        <h2>Upload Clinical Report</h2><br> 
        <form action="prescription_upload.php" method="post" enctype="multipart/form-data">
            <label for="report" class="file-label"><br><br><br>Select PDF File:</label><br>
            <input type="file" id="report" name="report" accept=".pdf"><br><br>
            <!-- Add hidden input fields to pass patient details to the upload_process.php script -->
            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
            <input type="hidden" name="patient_name" value="<?php echo $patient_name; ?>">
            <input type="hidden" name="patient_email" value="<?php echo $patient_email; ?>">
            <input type="submit" value="Upload Report">
        </form>
    </div>
</body>
</html>
