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
            // Get the email from the URL
            $email = $_SESSION['email'];
        
            // Prepare a SQL statement to select the name based on the email
            $sql = "SELECT Name FROM tutorprofile WHERE Email = ?";
        
            // Assuming you're using MySQLi for database connection
            $stmt = $conn->prepare($sql);
            
            // Bind the email parameter to the SQL statement
            $stmt->bind_param("s", $email);
            
            // Execute the query
            $stmt->execute();
            
            // Bind the result variable
            $stmt->bind_result($name);
            
            // Fetch the result
            $stmt->fetch();
            
            // Display the name
            
            // Close the statement
            $stmt->close();
            // Prepare a SQL statement to select the TutorID based on the email
            $sql = "SELECT TutorID FROM tutorprofile WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($tutorid);
            $stmt->fetch();
            $stmt->close();
        } else {
            echo "Email parameter is not set.";
        }
        $off_sql = "UPDATE schedule SET Status = 'Off' WHERE Date < CURDATE()";
        $stmt = $conn->prepare($off_sql);
        $stmt->execute();
        $date_sql = "SELECT ScheduleID, DateTime, StudentName, Location FROM schedule WHERE TutorID = ? AND Status = 'On' ORDER BY DateTime ASC";
        $stmt = $conn->prepare($date_sql);
        $stmt->bind_param("i", $tutorid);
        $stmt->execute();
    
        // Bind result variables
        $stmt->bind_result($ScheduleID,$DateTime, $studentName, $location);
        // Fetch and display results
        $events = array();
        while ($stmt->fetch()) {
            $Time = date("d F, Y h:i A", strtotime($DateTime));
            $event = array(
                'Time' => htmlspecialchars($Time),
                'StudentName' => htmlspecialchars($studentName),
                'Location' => htmlspecialchars($location),
                'ScheduleID' => htmlspecialchars($ScheduleID)
            );
            
            // Push the event array into the $events array
            $events[] = $event;
        }
        
        // Close statement
        $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="schedule.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                <a href="profile.php"><button class="loginbut"><?php echo $name; ?></button></a>
                <a href="login.html"><button class="logoutbut">Logout</button></a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR ENDS -->

    <!-- BANNER -->
    <div class="text-center welbanner">
        <div class="row">
            <div class="col-sm-5">
                <img src="images/schedule banner.png" class="img-fluid welimg">
            </div>
            <div class="col-sm-5">
                <h2 class="welhead">Schedule Management</h2>
                <p class="welp">Find all the user-friendly schedule maintenance tools, designed to optimize your time and profit.</p>
            </div>
        </div>
    </div>
    <!-- BANNER ENDS -->

    <!-- MAIN -->
    <!-- TIMELINE -->
    <div class="container mt-12">
        <div class="row">
            <div class="col-sm-6 box3">
                <div>
                    <div class="timedate">
                        <button onclick="showEventForm()" class="addBox1 adddate1">Add New Event</button>
                        <button onclick="location.reload()" class="addBox1 adddate1">Reload</button>
                        <div id="eventForm" style="display: none;">
                        <form id="addEventForm" onsubmit="addEvent(); return false;">
                            <div class="mb-3">
                                <label for="eventDate" class="form-label">Date and Time:</label>
                                <input type="datetime-local" class="form-control" id="eventDate" placeholder="Select date" required>
                            </div>
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="eventName" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="eventAddress" class="form-label">Address:</label>
                                <input type="text" class="form-control" id="eventAddress" placeholder="Enter address" required>
                            </div>
                            <button type="submit" onclick="hideEventForm()" class="btn btn-success">Add Event</button>
                            <button type="button" onclick="hideEventForm()" class="btn btn-danger ml-2">Cancel</button>
                        </form>
                    </div>
                </div>
                    <!-- Scrollable pane -->
                    <div class="scroll-pane">
                        <div class="edu-container reveal">
                            <div class="row">
                                <div class="edu-contents1" id="edu-contents1">
                                <?php
                        // Check if there are events to display
                                if (!empty($events)) {
                                    // Loop through each event and generate HTML for each
                                    foreach ($events as $event) {
                                        ?>
                                        <div class="box">
                                            
                                            <h5 class="time"><?php echo htmlspecialchars($event['Time']); ?></h5>
                                            <h5 class="name"><?php echo htmlspecialchars($event['StudentName']); ?></h5>
                                            <p class="address"><?php echo htmlspecialchars($event['Location']); ?></p>
                                            <!-- <h5 class="name"><?php echo $event['ScheduleID']; ?></h5> -->
                                            <button class="btn btn-primary text-center delete-btn" onclick="deleteEvent(<?php echo $event['ScheduleID']; ?>)">Delete</button>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    // If no events found for the current date
                                    echo "<p>No events scheduled for today.</p>";
                                }
                                ?>
                                    <!-- Add more boxes dynamically -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of scrollable pane -->
                </div>
            </div>
            <div class="col-sm-6 box4">
                <img src="images/scheduleimg.png" class="schedimg">
            </div>
        </div>
    </div>
    <!-- MAIN ENDS -->

    <script src="schedule.js"></script>
    <script src="afterlogin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>