<?php
session_start();

// Check if the patient is logged in and retrieve their ID from the session
if (!isset($_SESSION['user'])) {
    echo "Error: Patient not logged in.";
    exit;
}

// Check if a file was uploaded
if (isset($_FILES['report']) && $_FILES['report']['error'] === UPLOAD_ERR_OK) {
    // Retrieve patient ID from session
    $pid = $_SESSION['user'];
    echo $pid;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "edoc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement
    $report_pdf = base64_encode(file_get_contents($_FILES['report']['tmp_name']));
   $stmt = $conn->prepare("INSERT INTO clinical_report (report_pdf) VALUES (?)");
    $stmt->bind_param("b", $report_pdf);

    // Assign uploaded file to variable
    $report_pdf = file_get_contents($_FILES['report']['tmp_name']);

    // Execute statement
    if ($stmt->execute() == TRUE) {
        echo "Report uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Display the PDF using an iframe with data URI
    if ($report_pdf !== null) {
        echo '<iframe src="data:application/pdf;base64,'.base64_encode($report_pdf).'" width="100%" height="600px"></iframe>';
    } else {
        echo "Report not found.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "Error uploading file.";
}
?>