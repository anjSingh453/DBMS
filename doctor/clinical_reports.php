<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clinical Reports</title>
</head>
<body>
    <h1>Clinical Reports</h1>

    <?php
    // Include database connection
    $servername = "localhost"; // Change this to your database server
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "edoc"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Query to fetch all reports
    $sql = "SELECT report_id,pid,pname, report_pdf,uploaded_at,patient_email FROM clinical_report";
    $result = $conn->query($sql);

    // Check if there are reports
    if ($result->num_rows > 0) {
        // Output iframe for each report
        while ($row = $result->fetch_assoc()) {
            $report_id = $row['report_id'];
            $patient_id=$row['pid'];
            $pname=$row['pname'];
            $uploaded=$row['uploaded_at'];
            $pemail=$row['patient_email'];
            //$report_name = $row['report_name'];
            $report_pdf = $row['report_pdf'];
            echo "REPORT_ID: ",$report_id,"<br>";
            echo "PATIENT_ID: ",$patient_id,"<br>";
            echo "PATIENT_NAME: ",$pname,"<br>";
            echo "UPLOADED_AT: ",$uploaded,"<br>";
            echo "PATIENT_EMAIL: ",$pemail,"<br>";
            //echo "<h2>Report $report_id: $report_name</h2>";
            echo "<object data='data:application/pdf;base64,".base64_encode($report_pdf)."' type='application/pdf' width='100%' height='400px'><p>Your browser does not support PDFs. Please download the PDF to view it: <a href='data:application/octet-stream;base64,".base64_encode($report_pdf)."'>Download PDF</a></p></object>";
            echo "<br>";echo "<br>";echo "<br>";
        }
    } else {
        echo "No reports found.";
    }

    // Close database connection
    $conn->close();
    ?>

</body>
</html>