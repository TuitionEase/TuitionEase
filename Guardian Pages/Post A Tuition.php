<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";
// Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    // Get the email from the session
    $email = $_SESSION['email'];

    // Prepare a SQL statement to select the name based on the email
    $sql = "SELECT Name FROM guardianprofile WHERE Email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Email parameter is not set.";
    exit;
}

// Fetch the tuitions data
$sql = "SELECT TuitionID, Title, PostingDate, TuitionType, Salary, Subjects, Location, Preferrence, ContactNumber, Status FROM tuitions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuitionEase</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP -->

    <!-- OPENSANS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Overpass&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- OPENSANS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleratnajit.css">
    <link rel="stylesheet" href="post_tuition.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="images\logo.png" alt="TuitionEase" style=" width: 330px; margin-left: -100px; margin-top: 10px;"></img>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="GuardianHome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Post A Tuition.php">Post A Tuition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="GuardianViewTutors.php">View Tutors</a>
                </li>
            </ul>
            <a href="login.html"><button class="logoutbut">Logout</button></a>
        </div>
        </div>
      </nav>
    <!-- NAVBAR ENDS -->
    
    <div>
        <h2 class="TuitionPost-head">Post your tuition details here</h2>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // This block runs only when the form is submitted

        // Database connection details
        $servername = "localhost";
        $username = "root"; // Default XAMPP username
        $password = ""; // Default XAMPP password (empty)
       // Default XAMPP password (empty)
        $dbname = "tuitionease"; // Change to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $version = $_POST['version'];
        $class = $_POST['class'];
        $days_per_week = $_POST['days_per_week'];
        $tutoring_type = $_POST['tutoring_type'];
        $subject = $_POST['subject'];
        $location = $_POST['location'];
        $fee = $_POST['fee'];
        $gender_preference = $_POST['gender_preference'];
        $contact_number = $_POST['contact_number'];
        $status = 'Pending';
        // Generate Title
        $title = "Need " . $version . " tutor for Class " . $class . " student - " . $days_per_week . " Days/Week";
        $current_date = date("Y-m-d");

        // Retrieve the total count of TutorID
        $result = $conn->query("SELECT COUNT(TuitionID) AS total FROM tuitions");
        $row = $result->fetch_assoc();
        $tutionID = $row['total'] + 1; // Incrementing by 1 to get the next ID

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO tuitions (TuitionID,Title,PostingDate,TuitionType,Salary,Subjects,Location,Preferrence,ContactNumber,Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $tutionID, $title, $current_date, $tutoring_type,$fee,$subject, $location,$gender_preference, $contact_number,$status);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } else {
        ?>
            <div class="main mt-3">
                
                    <div class="col-lg-6 Tuit1">
                        <div class="posttuition">
                            <form action="" method="post">
                                <div class="Input">
                                    <input type="text" name="version" required>
                                    <div class="labelline">Version - Bangla Medium, English Medium?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="class" required>
                                    <div class="labelline">Class?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="days_per_week" required>
                                    <div class="labelline">Days per Week?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="tutoring_type" required>
                                    <div class="labelline">Tutoring Type - Home Tutoring, Online Tutoring?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="subject" required>
                                    <div class="labelline">What subject or topics is the tuition for?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="location" required>
                                    <div class="labelline">Location of tuition?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="fee" required>
                                    <div class="labelline">Proposed tuition fee?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="gender_preference" required>
                                    <div class="labelline">Gender Preference - Male, Female or No Preference?</div>
                                </div>
                                <div class="Input">
                                    <input type="text" name="contact_number" required>
                                    <div class="labelline">Contact Number</div>
                                </div>
                                <div class="buts">
                                    <button class="butTuit" type="submit" name="submit1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
        <?php
        }
        ?>


    <script src="index.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>