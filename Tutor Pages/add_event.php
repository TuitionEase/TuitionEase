<?php
session_start();

// Database connection settings
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

if (isset($_SESSION['email'])) {
    // Get the email from the session
    $email = $_SESSION['email'];
    // Prepare a SQL statement to select the TutorID based on the email
    $sql = "SELECT TutorID FROM tutorprofile WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($tutorid);
    $stmt->fetch();
    $stmt->close();
    
    // Get the ScheduleID
    $result = $conn->query("SELECT COUNT(ScheduleID) AS total FROM schedule");
    $row = $result->fetch_assoc();
    $ScheduleID = $row['total'] + 1; 
    
    // Check if POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize POST data
        $date = $conn->real_escape_string($_POST['date']);
        $time = $conn->real_escape_string($_POST['time']);
        $name = $conn->real_escape_string($_POST['name']);
        $address = $conn->real_escape_string($_POST['address']);
        $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
        $status = 'On';
        // SQL query to insert data into the database
        $sql = "INSERT INTO schedule (ScheduleID, Time, StudentName, Location, TutorID, Date, DateTime, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssisss", $ScheduleID, $time, $name, $address, $tutorid, $date, $datetime, $status);
        
        if ($stmt->execute() === TRUE) {
            echo "New event created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
} else {
    echo "Email parameter is not set.";
}

// Close connection
$conn->close();
?>
