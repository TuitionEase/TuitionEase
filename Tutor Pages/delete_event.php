<?php
session_start();

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

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteScheduleID'])) {
    $scheduleID = $_POST['deleteScheduleID'];

    // Update query
    $update_sql = "UPDATE schedule SET Status = 'Off' WHERE ScheduleID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $scheduleID);

    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch events to display
$events = array(); // Assuming $events is populated with data from the database

$conn->close();
?>
