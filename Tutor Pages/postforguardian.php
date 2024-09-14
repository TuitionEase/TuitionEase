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
        } else {
            echo "Email parameter is not set.";
        }
        $sql = "SELECT TuitionID, Title, PostingDate, TuitionType, Salary, Subjects, Location, Preferrence, ContactNumber FROM tuitions WHERE Status = 'Accepted'";
        $result = $conn->query($sql);
        $result2 = $conn->query("SELECT COUNT(TuitionID) AS total FROM tuitions WHERE Status = 'Accepted'");
        $row = $result2->fetch_assoc();
        $tuitionCount = $row['total'];
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
    <link rel="stylesheet" href="stylePost.css">
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

    <div class="boxx">
        <div class="leftt"><img src="images/job1.png" alt=""></div>
        <div class="rightt">
            <h2><?php echo $tuitionCount; ?> jobs found</h2>
        </div>
            
    
    </div>

    <!-- BANNER ENDS -->


    <!-- OFFERS SECTOIN -->

    <!-- This is the php code -->
    
    <div class="containerr">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $index = 0;
                while($row = $result->fetch_assoc()) {
                    // Sanitize output
                    $tuitionid = htmlspecialchars($row["TuitionID"], ENT_QUOTES, 'UTF-8');
                    $title = htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8');
                    $posted = htmlspecialchars($row["PostingDate"], ENT_QUOTES, 'UTF-8');
                    $type = htmlspecialchars($row["TuitionType"], ENT_QUOTES, 'UTF-8');
                    $salary = htmlspecialchars($row["Salary"], ENT_QUOTES, 'UTF-8');
                    $subject = htmlspecialchars($row["Subjects"], ENT_QUOTES, 'UTF-8');
                    $location = htmlspecialchars($row["Location"], ENT_QUOTES, 'UTF-8');
                    $preference = htmlspecialchars($row["Preferrence"], ENT_QUOTES, 'UTF-8');
                    $contactnumber = htmlspecialchars($row['ContactNumber']);
                    if($preference!='No preferrence') $preference = $preference . " tutor preferred";
                    $preference_image = 'Male.jpg';
                    if($preference=='Male tutor preferred') $preference_image = 'Male.jpg';
                    else if($preference=='Female tutor preferred') $preference_image = 'female_9977431.png';
                    else $preference_image = 'Both.png';
                    $boxClass = 'box' . ($index % 2 + 1);
                    echo <<<HTML
                    <div class="col-sm-6 $boxClass">
                        <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                            <h3>$title</h3>
                            <div class="col-sm-12 po1">
                                <div><p>Job ID: $tuitionid</p></div>
                                <div><p>Posted: $posted</p></div>
                            </div>
                            <div class="col-sm-12 po2">
                                <div><p><img src="images/tuition.png" alt="">Tuition Type</p></div>
                                <div><p><img src="images/money_428387.png" alt="">Salary</p></div>
                                <div><p><img src="images/book_7611592.png" alt="">Subject</p></div>
                            </div>
                            <div class="col-sm-12 po">
                                <div><p>$type</p></div>
                                <div><p>$salary</p></div>
                                <div><p>$subject</p></div>
                            </div>
                            <div class="pp">
                                <p><img src="images/gps_11081564.png">Location</p>
                                <h5 class="lo">$location</h5>
                            </div>
                            <div class="pref">
                                <h5 class="lo"><img src="images/$preference_image">$preference</h5>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-info buthcont">Contact : $contactnumber</button>
                            </div>
                        </div>
                    </div>
HTML;
                    if (($index + 1) % 2 == 0) {
                        echo '</div><div class="row">';
                    }
                    $index++;
                }
            } else {
                echo "<p>No tuitions available.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>   

    <!-- This is the html base code -->


    <!-- <div class="containerr">
        <div class="row">
            <div class="col-sm-6 box1">
                <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                    <h3>Need English Version Tutor For HSC - 2nd Year Student - 3 Days/Week</h3>
                    <div class="col-sm-12 po1">
                        <div><p>Job ID: 2004008</p></div>
                        <div>
                            <p> Posted:  Mar 08, 2024</p>
                        </div>  
                    </div>
                    <div class="col-sm-12 po2">
                        <div><p><img src="images/tuition.png" alt="">Tuition Type</p></div>
                        <div><p><img src="images/money_428387.png" alt="">Salary</p></div>
                        <div>
                            <p><img src="images/book_7611592.png" alt="">Subject</p>
                        </div>  
                    </div>
                    <div class="col-sm-12 po">
                        <div><p>Home Tutoring</p></div>
                        <div><p>8,000</p></div>
                        <div>
                            <p>Physics, Chemistry</p>
                        </div>  
                    </div>
                    <div class="pp">
                        <p><img src="images/gps_11081564.png">Location</p>
                        <h5 class="lo">Mirpur,Dhaka</h5>
                    </div>
                    <div class="pref">
                        <h5 class="lo"><img src="images/Male.jpg">Male Tutor Preferred</h5>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-info buth1">See Details</button>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-sm-6 box2">
                <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                    <h3>Need Bangla Medium Tutor For Class 5 Student -4 Days/Week</h3>
                    <div class="col-sm-12 po1">
                        <div><p>Job ID: 2004023</p></div>
                        <div>
                            <p> Posted:  Mar 08, 2024</p>
                        </div>  
                    </div>
                    <div class="col-sm-12 po2">
                        <div><p><img src="images/tuition.png" alt="">Tuition Type</p></div>
                        <div><p><img src="images/money_428387.png" alt="">Salary</p></div>
                        <div>
                            <p><img src="images/book_7611592.png" alt="">Subject</p>
                        </div>  
                    </div>
                    <div class="col-sm-12 po">
                        <div><p>Home Tutoring</p></div>
                        <div><p>3,500</p></div>
                        <div>
                            <p>Science, Math</p>
                        </div>  
                    </div>
                    <div class="pp">
                        <p><img src="images/gps_11081564.png">Location</p>
                        <h5 class="lo">Mirpur,Dhaka</h5>
                    </div>
                    <div class="pref">
                        <h5 class="lo"><img src="images/female_9977431.png">Female Tutor Preferred</h5>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-info buth1">See Details</button>
                </div>
            </div> -->
        </div>
    </div>
    <!-- OFFER SECTION ENDS -->


    <!-- TIMELINE -->

    




    <script src="welcome.js"></script>
    <script src="afterlogin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
</body>
</html>