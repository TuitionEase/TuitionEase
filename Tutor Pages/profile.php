<?php
session_start();
// Assuming you have established a database connection
$servername = "localhost";
$username = "root";
$password = "Hello_there12";
$dbname = "tuitionease";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username is set in the URL parameters
if(isset($_SESSION['email'])) {
    // Fetch user data from the database based on the provided username
    $username = $_SESSION['email'];
    
    // Prepare a SQL statement
    $sql = "SELECT Name, TutorID, Email, PhoneNumber, Address, Gender, DOB, EdQual, FBID, DP FROM tutorprofile WHERE Email = ?";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        $imageData = base64_encode($user['DP']);
    } else {
        echo $username;
        echo "User not found.";
        exit(); // Stop execution if user not found
    }
    $tutorid = $user['TutorID'];
    $stmt = $conn->prepare("SELECT COUNT(*) AS cur_students FROM studentdetails WHERE tutorid = ? AND status = 'Running'");
    $stmt->bind_param("i", $tutorid);
    $stmt->execute();
    $stmt->bind_result($cur_students);
    $stmt->fetch();
    $stmt->close();
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_students FROM studentdetails WHERE tutorid = ?");
    $stmt->bind_param("i", $tutorid);
    $stmt->execute();
    $stmt->bind_result($total_students);
    $stmt->fetch();
} else {
    // Redirect to the login page if username is not provided
    header("Location: login.html");
    exit();
}

// Close connection
$conn->close();
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
    <link rel="stylesheet" href="./profile.css">
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
                        <a class="nav-link" href="./welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./resource.php">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./schedule.php">Schedule Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./sendstudentdetails.php">Student Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./postforguardian.php">Find A Tuition</a>
                    </li>
                </ul>
                <a href="./profile.php"><button class="loginbut"><?php echo $name; ?></button></a>
                <a href="./Login & Signup/login.php"><button class="logoutbut">Logout</button></a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR ENDS -->

    <div class="main mt-3">
        <div class="row">
            <div class="col-lg-3 Tuit1">
                <div class = "container">
                    <div class = "card">
                        <div class = "img1">
                          <a href = "#">
                          <!-- <img src = "images\Ratnajit_Dhar.png"> -->
                          <?php echo '<img src="data:image/jpeg;base64,' . $imageData . '">'; ?>
                        </a>  
                        </div>
                        <div class="info">
                            <h2 class="Name" style="font-family: 'Canva Sans', sans-serif; font-size: 25px;"><?php echo $user['Name']; ?></h2>
                            <h3 class="TutorID" style="font-family: 'Canva Sans'sans-sarif; font-size: 15px;">Tutor ID: <?php echo $user['TutorID']; ?></h3>
                        </div>
                        <div class="buts">
                            <button class="butTuit">Edit Information</button>
                        </div>
                        <div class="info2">
                            <img class="emailIcon" src="icons\EmailIcon.png" alt="Email Icon" style=" width: 20px; margin-left: -40px; margin-top: 10px;"></img>
                            <h2 class="emailicon2" style="font-family: 'Canva Sans', sans-serif; font-size: 15px; margin-left: -15px;margin-top:-18px;font-weight: bold">Email</h2>
                            <h2 class="email" style="font-family: 'Canva Sans'sans-sarif; font-size: 15px;margin-left: -15px;margin-top:-5px"><?php echo $user['Email']; ?></h2>
                            <img class="PhoneIcon" src="icons\PhoneIcon.png" alt="Phone Icon" style=" width: 20px; margin-left: -40px; margin-top: 10px;"></img>
                            <h2 class="PhoneIcon2" style="font-family: 'Canva Sans', sans-serif; font-size: 15px; margin-left: -15px;margin-top:-18px;font-weight: bold">Phone Number</h2>
                            <h2 class="Phone" style="font-family: 'Canva Sans'sans-sarif; font-size: 15px;margin-left: -15px;margin-top:-5px"><?php echo $user['PhoneNumber']; ?></h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-9 Tuit2">
                <div class = "two-box">
                    <div class="box-container">
                     <h2 class="CurrentTuition" style="font-family: 'Bebas Neue', sans-serif; font-size: 40px;">Current Tuitions</h2>
                      <h2 class="CurrentTuitionNum" style="font-family: 'Bebas Neue', sans-serif; font-size: 40px;"> <?php echo $cur_students; ?></h2>
                    </div>
                    <div class="box-container2">
                        <h2 class="MonthlySalary" style="font-family: 'Bebas Neue', sans-serif; font-size: 40px;">Total Tuitions</h2>
                         <h2 class="MonthlySalaryTotal" style="font-family: 'Bebas Neue', sans-serif; font-size: 40px;"><?php echo $total_students; ?></h2>
                       </div>
                </div>
                <hr class="line">
                <img class="infoicon" src="icons\InformationIcon.png" alt="Information Icon" style=" width: 40px; margin-left: 0px; margin-top: 0px;"></img>
                <h2 class="information" style="font-family: 'Bebas Neue', sans-serif; font-size: 40px;margin-left: 40px;margin-top: -43px;">Profile Information</h2>
                <p class="Address"><strong>Address:</strong><?php echo $user['Address']; ?></p>
                <p class="gender"><strong>Gender</strong>:</strong><?php echo $user['Gender']; ?></p>
                <p class="DOB"><strong>Date of Birth:</strong><?php echo $user['DOB']; ?></p>
                <p class="EdQual"><strong>Educational Qualification:</strong><?php echo $user['EdQual']; ?></p>
                <p class="FB"><strong>Facebook ID:</strong> <a href="<?php echo $user['FBID']; ?>"><?php echo $user['FBID']; ?></a></p>




            </div>
        </div>
    </div>