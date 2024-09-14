<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tuitionease";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request for removing student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentid'])) {
    $studentid = $_POST['studentid'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE studentdetails SET status = 'Canceled' WHERE studentid = ?");
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $studentid);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error executing statement: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit;
}

// Standard page load
$name = "";
$tutorId = "";
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Retrieve tutorId using email
    $sql = "SELECT Name, tutorId FROM tutorprofile WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name, $tutorId);
    $stmt->fetch();
    $stmt->close();

    if (empty($tutorId)) {
        die("No tutorId found for this email: " . htmlspecialchars($email));
    }
} else {
    die("Email parameter is not set.");
}

// Fetch student details for the logged-in tutor
$sql = "SELECT studentid, tutorId, student_name, phone_number, class, address, subjects FROM studentdetails WHERE tutorId = ? AND status = 'Running'";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $tutorId);
$stmt->execute();
$result = $stmt->get_result();

$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

$stmt->close();
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
    <link rel="stylesheet" href="styleStu.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="images/logo.png" alt="TuitionEase" style="width: 330px; margin-left: -100px; margin-top: 10px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resource.php">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">Schedule Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="studentDetails.php">Student Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="postforguardian.php">Find A Tuition</a>
                    </li>
                </ul>
                <a href="profile.php"><button class="loginbut"><?php echo htmlspecialchars($name); ?></button></a>
                <a href="login.html"><button class="logoutbut">Logout</button></a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR ENDS -->

    <div class="box">
        <div class="left"><img src="images/sd.png" alt=""></div>
        <div class="right">
            <h1 class="head">STUDENT DETAILS</h1>
            <p class="stu">Access extensive student information, allowing for personalized tutoring sessions</p>
            <p class="stu1">This provides valuable insights that enable personalized tutoring sessions</p>
            <p class="stu2">tailored to each student's needs</p>
        </div>
    </div>

    <div class="container custom-margin">
    <?php
    $chunks = array_chunk($students, 3); // Split students into chunks of 3 for each row
    foreach ($chunks as $chunk) {
        echo '<div class="row mb-4">'; // Start a new row
        foreach ($chunk as $student) {
            echo '<div class="col-md-4 d-flex align-items-stretch">'; // Each student card in a 4-column layout
            echo '<div class="card mx-2 mb-4" id="card-' . $student['studentid'] . '">
                    <div class="img-wrapper">
                        <img class="card-img-top" src="images/stu.png" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($student['student_name']) . '</h5>
                        <h6 class="card-title">' . htmlspecialchars($student['phone_number']) . '</h6>
                        <p class="card-text">Class: ' . htmlspecialchars($student['class']) . '</p>
                        <p class="card-text">Address: ' . htmlspecialchars($student['address']) . '</p>
                        <p class="card-text">Subjects: ' . htmlspecialchars($student['subjects']) . '</p>
                        <a href="#" class="stubtn btn btn-primary" data-studentid="' . $student['studentid'] . '">Remove</a>
                    </div>
                  </div>';
            echo '</div>'; // End column
        }
        echo '</div>'; // End row
    }
    ?>
    </div>

    <div class="containerform" id="Add Student">
    <h2>Add Student</h2>
    <form action="sendstudentdetails.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>
    </div>
    <div class="form-group">
        <label for="class">Class:</label>
        <input type="text" id="class" name="class" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
    </div>
    <div class="form-group">
        <label for="subjects">Subjects:</label>
        <input type="text" id="subjects" name="subjects" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn">Submit</button>
    </div>
</form>

    </div>
</a>


      
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="afterlogin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="studetails.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
