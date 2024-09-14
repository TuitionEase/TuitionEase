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

// Fetch the tutor details
 $sql = "SELECT Name, TutorID, Email, PhoneNumber, Address, Gender, DOB, EdQual, FBID, DP FROM tutorprofile WHERE Status = 'Accepted'";
//$sql = "SELECT Name, Qualification, ContactNumber, ImagePath FROM tutors"; // Replace `tutors` with your actual table name
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

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>

    <!-- OPENSANS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Overpass&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- OPENSANS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="GuardianViewTutors.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="images\logo.png" alt="TuitionEase" style="width: 330px; margin-left: -100px; margin-top: 10px;">
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

    <div class="box">
        <div class="left"><img src="images\viewtutor.png" alt=""></div>
        <div class="right">
        <h1 class="head">View Tutors</h1>
        <p class="stu">Here you'll find all the tutors we have on board with us. </p>
        <p class="stu1">You can directly contact using the contact button.</p>
    </div>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <?php $imageData = base64_encode($row['DP']); ?>
            <div class="con">
                <div class = "left">
                    <img style="border-radius: 0%;" src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="">
                </div>
                <div class="right">
                    <h2><?php echo $row['Name']; ?></h2>
                    <p><i class="fa-solid fa-graduation-cap" style="color: #47afff;"></i> <?php echo $row['EdQual']; ?></p>
                    <p><i class="fa-solid fa-phone" style="color: #44a4ee;"></i> <a href="tel:+<?php echo $row['PhoneNumber']; ?>" style="color: inherit; text-decoration: none;"><?php echo $row['PhoneNumber']; ?></a></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tutors available at the moment.</p>
    <?php endif; ?>

    <!-- SERVICES ENDS -->
    <script src="afterlogin.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
