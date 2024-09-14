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
        $date_sql = "SELECT Time, StudentName, Location FROM schedule WHERE TutorID = ? AND DATE(Date) = CURDATE() AND Status = 'On' ORDER BY DateTime ASC";
        $stmt = $conn->prepare($date_sql);
        $stmt->bind_param("i", $tutorid);
        $stmt->execute();
    
        // Bind result variables
        $stmt->bind_result($time, $studentName, $location);
        // Fetch and display results
        $events = array();
        while ($stmt->fetch()) {
            $Time = date("h:i A", strtotime($time));
            $event = array(
                'Time' => htmlspecialchars($Time),
                'StudentName' => htmlspecialchars($studentName),
                'Location' => htmlspecialchars($location)
            );
            
            // Push the event array into the $events array
            $events[] = $event;
            $events = array_reverse($events);
        }
        
        // Close statement
        $stmt->close();
        $rem_sql = "SELECT noteId, description FROM reminder WHERE status = 'On' AND tutorId = ? ORDER BY noteId DESC";
            $stmt = $conn->prepare($rem_sql);
            $stmt->bind_param("i", $tutorid);
            $stmt->execute();
            $stmt->bind_result($noteId, $description);
            $reminders = array();
            while ($stmt->fetch()) {
                $rem = array(
                    'description' => htmlspecialchars($description),
                    'noteId' => htmlspecialchars($noteId)
                );
                $reminders[] = $rem;
            }
            $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Profile</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <!-- NAVBAR -->
    
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <img class="logo" src="..\images\logo.png" alt="TuitionEase" style="width: 330px; margin-left: -100px; margin-top: 10px;">
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




    <!-- BANNER -->

    <div class="text-center welbanner">
        <div class="row">
            <div class="col-sm-5">
                <img src="..\images\welbanner.png" class="img-fluid welimg">
            </div>
            <div class="col-sm-5">
            <h2 class="welhead">Welcome, <?php echo $name; ?>!</h2>
                <p>Make your tuition experience better and easier, with TuitionEase</p>
            </div>
        </div>
    </div>

    <!-- BANNER ENDS -->


    <!-- OFFERS SECTOIN -->
    <div class="containerr">
        <div class="row">
            <div class="col-sm-6 box1">
                <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                    <div class="col-sm-9">
                        <p>Some new offers are posted</p>
                    </div>
                    <div class="col-sm-3">
                    <button type="button" class="btn btn-info buth1" onclick="window.location.href='postforguardian.php';">See Details</button>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 box2">
                <div class="row align-items-center" style="height: 100%;">
                    <div class="col-sm-9">
                        <p>Got a new tuition?</p>
                    </div>
                    <div class="col-sm-3">
                    <button type="button" class="btn btn-info buth2" onclick="window.location.href='studentdetails.php#Add Student';">Add Information</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OFFER SECTION ENDS -->


    <!-- TIMELINE -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 box3">
                <div class="border border-primary p-4 rounded">
                    <h4 class="text-center timehead">Today's Schedule</h4>
                    <p class="text-center timep"><?php echo date('d F, Y'); ?></p>
                    
                    <!-- Scrollable pane -->
                    <div class="scroll-pane">
                        <div class="edu-container reveal">
                            <div class="row">
                                <div class="edu-contents" id="edu-contents">
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
            
                    <!-- Add New Event button -->
                   
                </div>
            </div>
            

        <div class="col-sm-6 box4">
        <div class="border border-primary p-4 rounded">
            <h4 class="text-center timehead">Reminder</h4>
            <div class="text-center">
             <button class="btn btn-primary mb-3" style="background-color: #42adf0" onclick="showAddReminderForm()">Create Reminder</button>
            </div>

            <div id="addReminderForm" style="display: none;">
                <div class="mb-3">
                    <label for="reminderDescription" class="form-label">Reminder:</label>
                    <textarea class="form-control" id="reminderDescription" rows="3"></textarea>
                </div>
                <button class="btn btn-success" style="margin-left:190px;margin-top:15px; margin-bottom:20px;" onclick="addReminder()">Save Changes</button>
                <button class="btn btn-danger" style="margin-top:15px; margin-bottom:20px;" onclick="hideAddReminderForm()">Cancel</button>
            </div>
            <div class="scroll-pane">
                <div class="edu-container reveal">
                    <div class="row">
                        <div class="edu-contents" id="edu-contents">
                            <?php
                            // Check if there are events to display
                            if (!empty($reminders)) {
                                // Loop through each event and generate HTML for each
                                foreach ($reminders as $rem) {
                                    ?>
                                    <div class="reminder-box">
                                        <h5><?php echo htmlspecialchars($rem['description']); ?></h5>
                                        <button class="btn btn-danger delete-btn" style="margin-left:380px; margin-top: -2px;" onclick="deleteReminder(<?php echo htmlspecialchars($rem['noteId']); ?>)">Delete</button>
                                    </div>
                                    <?php
                                }
                            } else {
                                // If no events found for the current date
                                echo "<p>No Reminder.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reminders"></div>
        </div>
    </div>
        </div>
    </div>

    <!-- TIMELINE ENDS -->



<!-- REVIEW SUBMIT -->
<div class="wrapper" style="margin-left: 480px; margin-top: 50px;">
    <h3>Post a review!</h3>
    <form action="submit_review.php" method="POST">
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
            <img class="logo" src="..\images\logo.png" alt="TuitionEase" style=" width: 500px; margin-top: -60px; margin-left: -90px;"></img>

            <p class="footer-links" style="margin-top:-10px;">
                <a href="index.html">Home</a>
                |
                <a href="../Guardian Pages/Post A Tuition.html">Post A Tuition</a>
                |
                <a href="#services">Our Services</a>
                |
                <a href="#reviews">Reviews</a>
                |
                <a href="#ourteam">Our Team</a>
            </p>

            <p class="footer-company-name">Copyright © 2024 <strong>TuitionEase</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i>
                <p><span>CUET</span>
                    Chattogram</p>
            </div>

            <div>
                <i class="fa-solid fa-phone" style="color: #74C0FC;"></i>
                <p>+88 74**9**258</p>
            </div>
            <div>
                <i class="fa-solid fa-envelope" style="color: #74C0FC;"></i>
                <p><a href="arpitamallik13@gmail.com">tuitionease@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>TuitionEase</strong> is your personalized tutoring solution! Our experienced tutors are dedicated to helping students excel in their studies. With customized lessons and convenient online sessions, we're here to support your academic journey. Join us today and unlock your full potential with TuitionEase!
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa-brands fa-facebook" style="color: #007fe0;"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin" style="color: #3477ea;"></i></i></a>
    
            </div>
        </div>
    </footer>




    <script src=".\Tutor Pages\welcome.js"></script>
    <script src=".\Tutor Pages\afterlogin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
</body>
</html>