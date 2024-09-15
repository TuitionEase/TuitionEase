<?php
// Database connection'

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();


$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if action and TutorID are set in POST data
    if (isset($_POST['action']) && isset($_POST['TutorID'])) {
        $action = $_POST['action'];
        $tutorID = $_POST['TutorID'];
        $fetchinfo = "SELECT Email, Name FROM tutorprofile WHERE TutorID = ?";
        $stmt = $conn->prepare($fetchinfo);
        $stmt->bind_param("i",$tutorID);
        $stmt->execute();
        $stmt->bind_result($email, $user);
        $stmt->fetch();
        $stmt->close();
        // Perform action based on button clicked
        if ($action == 'accept') {
            // Update tutor profile status to 'Accepted'
            $updateSql = "UPDATE tutorprofile SET status = 'Accepted' WHERE TutorID = ?";

        } elseif ($action == 'reject') {
            // Update tutor profile status to 'Rejected'
            $updateSql = "UPDATE tutorprofile SET status = 'Rejected' WHERE TutorID = ?";
        }

        // Prepare and execute the update query
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("s", $tutorID);
        if ($stmt->execute()) {
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'tuitioneaseweb@gmail.com';
                $mail->Password = /Add your password here/;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('tuitioneaseweb@gmail.com');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Welcome to TuitionEase";
                $mail->Body = "Welcome " . $user . ",<br><br>Your account has been approved. You can now log in to your account with your email and password.<br><br>Make your tuition experience better and easier, with TuitionEase.";
                $mail->send(); 
            } catch (Exception $e) {
                echo "<script>alert('Mail could not be sent. Mailer Error: " . $mail->ErrorInfo . "');</script>";
                $alertMessage = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
            header("Location: admin.php#pendingTutor");
            exit;
        } else {
            echo "Error processing action: " . $stmt->error;
        }

        $stmt->close();
    } else if (isset($_POST['action']) && isset($_POST['GuardianID'])){
        
        $action = $_POST['action'];
        $GuardianID = $_POST['GuardianID'];

        // Perform action based on button clicked
        if ($action == 'accept') {
            // Update tutor profile status to 'Accepted'
            $updateSql = "UPDATE guardianprofile SET status = 'Accepted' WHERE GuardianID = ?";
        } elseif ($action == 'reject') {
            // Update tutor profile status to 'Rejected'
            $updateSql = "UPDATE guardianprofile SET status = 'Rejected' WHERE GuardianID = ?";
        }

        // Prepare and execute the update query
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("s", $GuardianID);

        if ($stmt->execute()) {
            header("Location: admin.php#pendingGuardian");
            exit;
        } else {
            echo "Error processing action: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "Method not allowed.";
}

$conn->close();
?>
