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
    
    // SQL query to fetch resources
    $resource_sql = "SELECT ResourceID, Name, Type FROM resource WHERE TutorID = ? AND Type = 'Textbook'";
    $stmt = $conn->prepare($resource_sql);
    $stmt->bind_param("i", $tutorid);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Email parameter is not set.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <!-- BOOTSTRAP -->

     <link rel="stylesheet" href="pdfs.css">
 
</head>
<body>
    
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



    <div class="container" style="margin-top: 50px;">
        <h1>Textbook List</h1>
        <ul class="pdf-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resourceID = $row['ResourceID'];
                $pdfName = htmlspecialchars($row['Name']);
                $pdfType = htmlspecialchars($row['Type']);
                echo '<li class="pdf-item">';
                echo '<span class="pdf-id"><i class="fa-solid fa-book" style="color: #74C0FC;"></i></span>';
                echo '<a href="serve_pdf.php?id=' . $resourceID . '" target="_blank">' . $pdfName . ' - ' . $pdfType . '</a>';
                echo '</li>';
            }
        } else {
            echo "No resources found.";
        }
        ?>
        </ul>
      </div>






    <script src="swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
</body>
</html>