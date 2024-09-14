
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

if (isset($_SESSION['email']) && isset($_GET['id'])) {
    // Get the email from the session
    $email = $_SESSION['email'];
    $id = $_GET['id'];
    
    // Prepare a SQL statement to select the TutorID based on the email
    $sql = "SELECT TutorID FROM tutorprofile WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($tutorid);
    $stmt->fetch();
    $stmt->close();
    
    // SQL query to fetch the specific resource
    $resource_sql = "SELECT PDF FROM resource WHERE TutorID = ? AND ResourceID = ?";
    $stmt = $conn->prepare($resource_sql);
    $stmt->bind_param("ii", $tutorid, $id);
    $stmt->execute();
    $stmt->bind_result($pdf);
    $stmt->fetch();
    
    if ($pdf) {
        header('Content-Type: application/pdf');
        echo $pdf;
    } else {
        echo "PDF not found.";
    }
    $stmt->close();
} else {
    echo "Email or resource ID parameter is not set.";
}

// Close the database connection
$conn->close();
?>
