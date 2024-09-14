<?php
// Database connection details
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
// Function to handle file upload
// Function to handle form submission for tutors
function processTutorForm($conn) {
    // Prepare and bind SQL statement
    $result = $conn->query("SELECT COUNT(TutorID) AS total FROM tutorprofile");
    $status = 'Pending';
    $row = $result->fetch_assoc();
    $tutorid = $row['total'] + 1; 
    $null = NULL;
    $stmt = $conn->prepare("INSERT INTO tutorprofile (TutorID, Name, PhoneNumber, Email, Password, Address, Gender, DOB, EdQual, FBID, DP, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssbs", $tutorid, $name, $phone, $email, $password, $address, $gender, $dob, $edu_qualification, $fb_link, $null, $status);

    // Set parameters
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $edu_qualification = $_POST['edqual'] . ' in ' . $_POST['field_of_study'] . ', ' . $POST['Institution'];
    $fb_link = $_POST['fbid'];
    $file = $_FILES['profile-picture'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileData = file_get_contents($fileTmpName);
    $stmt->send_long_data(10, $fileData);
    // Execute SQL statement
    $stmt->execute();
    // Close statement and connection
    $stmt->close();
}

// Function to handle form submission for guardians
function processGuardianForm($conn) {
    // Prepare and bind SQL statement
    $result = $conn->query("SELECT COUNT(GuardianID) AS total FROM guardianprofile");
    $status = 'Pending';
    $row = $result->fetch_assoc();
    $guardianid = $row['total'] + 1; 
    $null = NULL;
    $stmt = $conn->prepare("INSERT INTO guardianprofile (guardianID, Name, PhoneNumber, Email, Password, Address, Gender, DOB, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $guardianid, $name, $phone, $email, $password, $address, $gender, $dob, $status);
    // Set parameters
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    // Execute SQL statement
    $stmt->execute();
    // Close statement and connection
    $stmt->close();
 }

// Check which form is submitted and process accordingly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup_type']) && $_POST['signup_type'] == 'tutor') {
        processTutorForm($conn);
        echo '<script>alert("Tutor registration pending approval!"); window.location.href = "login.html";</script>';
    } elseif (isset($_POST['signup_type']) && $_POST['signup_type'] == 'guardian') {
        processGuardianForm($conn);
        echo '<script>alert("Guardian registration pending approval!"); window.location.href = "login.html";</script>';
    } else {
        echo "Invalid form submission.";
    }
}

// Close database connection
$conn->close();
?>
