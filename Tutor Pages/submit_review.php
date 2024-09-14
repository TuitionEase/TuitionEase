<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $opinion = htmlspecialchars($_POST['opinion'], ENT_QUOTES, 'UTF-8');

    // Validate data
    if (!empty($opinion)) {
        // Retrieve tutor's email from session
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Prepare SQL statement to get tutor's name
            $sql_name = "SELECT Name FROM tutorprofile WHERE Email = ?";
            $stmt_name = $conn->prepare($sql_name);
            $stmt_name->bind_param("s", $email);
            $stmt_name->execute();
            $stmt_name->bind_result($name);
            $stmt_name->fetch();
            $stmt_name->close();

            // Define user_type and dp
            $user_type = 'Tutor';
            $dp = ''; // Assuming dp is empty, you can update this if needed

            // SQL to insert the review
            $sql_insert = "INSERT INTO review (name, des, user_type, dp) VALUES (?, ?, ?, ?)";

            // Prepare and bind parameters
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssss", $name, $opinion, $user_type, $dp);

            if ($stmt_insert->execute()) {
                echo "Review submitted successfully!";
            } else {
                echo "Error: " . $stmt_insert->error;
            }

            // Close statement
            $stmt_insert->close();
        } else {
            echo "Session email parameter is not set.";
        }
    } else {
        echo "Invalid data. Please check your input.";
    }
}

// Close connection
$conn->close();
?>
