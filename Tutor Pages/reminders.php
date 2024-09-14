<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT TutorID FROM tutorprofile WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($tutorid);
    $stmt->fetch();
    $stmt->close();
    $result = $conn->query("SELECT COUNT(noteId) AS total FROM reminder");
    $row = $result->fetch_assoc();
    $noteid = $row['total'] + 1; 
    if (isset($_GET['action'])) {
        $action = $_GET['action'];


        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $conn->real_escape_string($_POST['description']);

            $sql = "INSERT INTO reminder (noteId, tutorId, description, status) VALUES (?, ?, ?, 'On')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $noteid, $tutorid, $description);

            $stmt->execute();

            $stmt->close();
        }

        if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $noteId = $conn->real_escape_string($_POST['noteId']);

            $sql = "UPDATE reminder SET status = 'Off' WHERE noteId = ? AND tutorId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $noteId, $tutorid);

            $stmt->execute();

            $stmt->close();
        }
    }
} else {
    echo "Please log in.";
}

$conn->close();
?>
