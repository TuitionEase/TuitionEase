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
    $email = $_SESSION['email'];
    $sql = "SELECT Name FROM guardianprofile WHERE Email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    $sql2 = "SELECT GuardianID FROM guardianprofile WHERE Email = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $email);
    $stmt2->execute();
    $stmt2->bind_result($guardianid);
    $stmt2->fetch();
    $stmt2->close();
} else {
    echo "Email parameter is not set.";
    exit;
}

// Fetch the tuitions data
$sql = "SELECT TuitionID, Title, PostingDate, TuitionType, Salary, Subjects, Location, Preferrence, ContactNumber, Status FROM tuitions WHERE GuardianID = ? AND Status = 'Accepted'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guardianid);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuitionEase</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- OPENSANS -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="GuardianHome.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="images/logo.png" alt="TuitionEase" style="width: 330px; margin-left: -100px; margin-top: 10px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="GuardianHome.php">Home</a>
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
    <!-- Welcome Banner -->
    <div class="text-center welbanner">
        <div class="row">
            <div class="col-sm-5">
                <img src="images\welbanner.png" class="img-fluid welimg">
            </div>
            <div class="col-sm-5">
                <h2 class="welhead">Welcome <?php echo $name; ?>!</h2>
                <p>Finding Tutors has never been easier before!</p>
            </div>
        </div>
    </div>

    <div class="boxx">
        <div class="leftt"><img src="images/job1.png" alt=""></div>
        <div class="rightt">
            <h2>Your Posted Offers</h2>
        </div>
    </div>

    <div class="containerr">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-sm-6 box1" style="font-family: \'Lato\', sans-serif; font-weight: bolder;">
                        <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                            <h3 style="font-weight: bolder;">' . htmlspecialchars($row["Title"]) . '</h3>
                            <div class="col-sm-12 po1">
                                <div><p>Job ID: ' . htmlspecialchars($row["TuitionID"]) . '</p></div>
                                <div><p>Posted: ' . htmlspecialchars($row["PostingDate"]) . '</p></div>  
                            </div>
                            <div class="col-sm-12 po2">
                                <div><p><img src="images/tuition.png" alt="">Tuition Type</p></div>
                                <div><p><img src="images/money_428387.png" alt="">Salary</p></div>
                                <div><p><img src="images/book_7611592.png" alt="">Subject</p></div>  
                            </div>
                            <div class="col-sm-12 po">
                                <div><p>' . htmlspecialchars($row["TuitionType"]) . '</p></div>
                                <div><p>' . htmlspecialchars($row["Salary"]) . '</p></div>
                                <div><p>' . htmlspecialchars($row["Subjects"]) . '</p></div>  
                            </div>
                            <div class="pp">
                                <p><img src="images/gps_11081564.png">Location</p>
                                <h5 class="lo">' . htmlspecialchars($row["Location"]) . '</h5>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="TuitionID" value="' . htmlspecialchars($row["TuitionID"]) . '">
                                    <button type="submit" class="btn btn-info buth1 reject-btn">Remove</button>
                                </form>
                            </div>
                            <div class="pref">
                                <h5 class="lo"><img src="images/' . ($row["Preferrence"] === "Male" ? "Male.jpg" : "female_9977431.png") . '">' . htmlspecialchars($row["Preferrence"]) . ' Tutor Preferred</h5>
                            </div>
                            <div style="padding-top:-30px">
                                <p style="padding-left:430px;">Contact</p>
                                <p style="padding-left:430px; padding-bottom:20px">' . htmlspecialchars($row["ContactNumber"]) . '</p>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p> You don't have any posted tuition currently</p>";
            }
            ?>
        </div>
    </div>

<?php
$conn->close();
?>

<!-- REVIEW SUBMIT -->
<div class="wrapper" style="margin-left: 480px; margin-top: 50px;">
    <h3>Post a review!</h3>
    <form action="submit_review1.php" method="POST">
        <textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..." required></textarea>
        <div class="btn-group">
            <button type="submit" class="btn submit">Submit</button>
            <button type="button" class="btn cancel">Cancel</button>
        </div>
    </form>
</div>
<!-- REVIEW ENDS -->

<!-- FOOTER -->
<footer class="footer-distributed" id="about">
    <div class="footer-left">
        <img class="logo" src="images/logo.png" alt="TuitionEase" style="width: 500px; margin-top: -60px; margin-left: -90px;">
        <p class="footer-links" style="margin-top:-10px;">
            <a href="index.html">Home</a> |
            <a href="Post A Tuition.html">Post A Tuition</a> |
            <a href="#services">Our Services</a> |
            <a href="#reviews">Reviews</a> |
            <a href="#ourteam">Our Team</a>
        </p>
        <p class="footer-company-name">Copyright © 2024 <strong>TuitionEase</strong> All rights reserved</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i>
            <p><span>CUET</span> Chattogram</p>
        </div>
        <div>
            <i class="fa-solid fa-phone" style="color: #74C0FC;"></i>
            <p>+8801XXXXXXXXX</p>
        </div>
        <div>
            <i class="fa-solid fa-envelope" style="color: #74C0FC;"></i>
            <p><a href="mailto:support@tuitionease.com" style="color: white;">support@tuitionease.com</a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about" style="font-weight: 400;">
            <span style="font-weight: bolder;">About Us</span>
            TuitionEase provides a simple and affordable way to connect tutors with students.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
