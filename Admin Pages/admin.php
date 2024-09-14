<?php
        session_start();
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        
        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';

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

        $sqlT = "SELECT TuitionID, Title, PostingDate, TuitionType, Salary, Subjects, Location, Preferrence, ContactNumber FROM tuitions";
        $resultT = $conn->query($sqlT);
        $result2T = $conn->query("SELECT COUNT(TuitionID) AS totalT FROM tuitions");
        $rowT = $result2T->fetch_assoc();
        $tuitionCountT = $rowT['totalT'];

        $result2P = $conn->query("SELECT COUNT(TuitionID) AS totalP FROM tuitions WHERE status = 'Pending';");
        $rowP = $result2P->fetch_assoc();
        $tuitionCountP = $rowP['totalP'];

        $sql = "SELECT TutorID, Name, Email, PhoneNumber, Address, Gender, DOB, EdQual, FBID, status FROM tutorprofile";
        $result = $conn->query($sql);
        $result2 = $conn->query("SELECT COUNT(TutorID) AS total FROM tutorprofile");
        $result3 = $conn->query("SELECT COUNT(TutorID) AS totalTP FROM tutorprofile WHERE status = 'Pending';");
        $row = $result2->fetch_assoc();
        $row2 = $result3->fetch_assoc();
        $tuitionCount = $row['total'];
        $tuitionCountP = $row2['totalTP'];

        $sqlG = "SELECT GuardianID,  Name, Email, PhoneNumber, Address, Gender, DOB FROM guardianprofile";
        $resultG = $conn->query($sqlG);
        $result2G = $conn->query("SELECT COUNT(GuardianID) AS totalG FROM guardianprofile");
        $result2GP = $conn->query("SELECT COUNT(GuardianID) AS totalGP FROM guardianprofile ");
        $rowG = $result2G->fetch_assoc();
        $rowGP = $result2GP->fetch_assoc();
        $tuitionCountG = $rowG['totalG'];
        $tuitionCountGP = $rowGP['totalGP'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="stylePost.css">
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
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tutor">Tutor Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#offers">Pending Offers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pendingTutor">Pending Tutor Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pendingTutor">Pending Guardian Profile</a>
              </li>
             
             
             
              
            </ul>
            <!-- <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            <a href="profile.html"><button class="loginbut"><?php echo $name; ?></button></a>
            <a href="login.html"><button class="loginbut">Logout</button></a>
          </div>
        </div>
      </nav>
    <!-- NAVBAR ENDS -->



    <div class="main-body">
        <h2 style="font-family: 'Bebas Neue', sans-serif;font-size: 45px;">Dashboard</h2>
        <!-- <div class="promo_card">
          <h1>Welcome to TuitionEase</h1>
          <span>Manage and streamline your platform effortlessly.</span>
        </div> -->
    </div>

    <section class="main">
        <div class="main-skills">
          <div class="card">
            <img src="images\icons8-teacher-48.png" style="width: 55px; margin-left: 135px;">
            <h3>Total No. of Tutors</h3>
            <p><?php echo $tuitionCountP; ?>+ joined in the last 7 days</p>
            <h1><?php echo $tuitionCount; ?></h1>
          </div>
          <div class="card">
            <img src="images\icons8-guardian-48.png" style="width: 55px; margin-left: 135px;">
            <h3>Total No. of Guardian</h3>
            <p><?php echo $tuitionCountGP; ?>+ joined in the last 7 days.</p>
            <h1><?php echo $tuitionCountG; ?></h1>
          </div>
          <div class="card">
            <img src="images\icons8-books-64.png" style="width: 55px; margin-left: 135px;">
            <h3>Total Tuition Offers</h3>
            <p><?php echo $tuitionCountP; ?>+ offers posted in the last 24 hours</p>
            <h1><?php echo $tuitionCountT; ?></h1>
          </div>

          <div class="card pending" href="#offers">
            <img src='images\icons8-pending-48.png' style="width: 55px; margin-left: 135px;">
            <h3>Pending Offers</h3>
            <p>10+ offers posted in the last 24 hours</p>
            <h1><?php echo $tuitionCountP; ?></h1>
          </div>
        </div>
    </section>

    <!-- TABLE -->

<?php
$sqlS = "SELECT TutorID, Name, PhoneNumber, Address, DOB, status FROM tutorprofile WHERE status = 'Accepted'";
$resultS = $conn->query($sqlS);
?>

<main class="table" id="customers_table" id="tutor">
    <section class="table__header">
        <h1 style="margin-left: 30px; font-family: 'Bebas Neue', sans-serif;font-size: 45px;">Tutor Details</h1>
        <div class="input-group">
            <input type="search" placeholder="Search Data...">
        </div>
        <div class="export__file">
            <label for="export-file" class="export__file-btn" title="Export File"></label>
            <input type="checkbox" id="export-file">
            <div class="export__file-options">
                <label>Export As &nbsp; &#10140;</label>
                <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
            </div>
        </div>
    </section>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th class="column-id">Id <span class="icon-arrow">&UpArrow;</span></th>
                    <th class="column-customer">Name <span class="icon-arrow">&UpArrow;</span></th>
                    <th class="column-location">Contact No <span></span></th>
                    <th class="column-location">Location <span class="icon-arrow">&UpArrow;</span></th>
                    <th class="column-order-date">Date Joined <span class="icon-arrow">&UpArrow;</span></th>
                    <th class="column-status">Status <span class="icon-arrow">&UpArrow;</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultS->num_rows > 0) {
                    // Output data of each row
                    while($rowS = $resultS->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $rowS["TutorID"] . "</td>";
                        echo "<td>" . $rowS["Name"] . "</td>";
                        echo "<td>" . $rowS["PhoneNumber"] . "</td>";
                        echo "<td>" . $rowS["Address"] . "</td>";
                        echo "<td>" . date("d M, Y", strtotime($rowS["DOB"])) . "</td>";
                        echo "<td >" . $rowS["status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No tutor details found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</main>


    <!-- OFFERS SECTOIN -->
    <h2 id="offers" style="margin-left:650px; font-family: 'Bebas Neue', sans-serif;font-size: 45px;">Pending Offers</h2>

<div class="containerr">
    <div class="row">
        <?php
        // SQL query to fetch tuitions
        $sqlZ = "SELECT TuitionID, Title, PostingDate, TuitionType, Salary, Subjects, Location, Preferrence, ContactNumber FROM tuitions WHERE status = 'Pending'";
        $resultZ = $conn->query($sqlZ);

        if ($resultZ->num_rows > 0) {
            $index = 0;
            while ($row = $resultZ->fetch_assoc()) {
                // Sanitize output
                $tuitionid = htmlspecialchars($row["TuitionID"], ENT_QUOTES, 'UTF-8');
                $title = htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8');
                $posted = htmlspecialchars($row["PostingDate"], ENT_QUOTES, 'UTF-8');
                $type = htmlspecialchars($row["TuitionType"], ENT_QUOTES, 'UTF-8');
                $salary = htmlspecialchars($row["Salary"], ENT_QUOTES, 'UTF-8');
                $subject = htmlspecialchars($row["Subjects"], ENT_QUOTES, 'UTF-8');
                $location = htmlspecialchars($row["Location"], ENT_QUOTES, 'UTF-8');
                $preference = htmlspecialchars($row["Preferrence"], ENT_QUOTES, 'UTF-8');
                
                // Adjust preference text and image
                if ($preference != 'No preference') {
                    $preference .= " tutor preferred";
                }
                $preference_image = ($preference == 'Male tutor preferred') ? 'Male.jpg' : (($preference == 'Female tutor preferred') ? 'female_9977431.png' : 'Both.png');

                // Determine box class for alternating colors
                $boxClass = 'box' . ($index % 2 + 1);

                // Output HTML for each tuition
                echo <<<HTML
                <div class="col-sm-6 $boxClass">
                <div class="row d-flex justify-content-between align-items-center" style="height: 100%;">
                    <h3>$title</h3>
                    <div class="col-sm-12 po1">
                        <div><p>Job ID: $tuitionid</p></div>
                        <div>
                            <p> Posted:  $posted</p>
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
                        <div><p>$type</p></div>
                            <div><p>$salary</p></div>
                            <div><p>$subject</p></div> 
                    </div>
                    <div class="pp">
                        <p><img src="images/gps_11081564.png">Location</p>
                        <h5 class="lo">$location</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="pref">
                                <h5 class="lo"><i class="fa-solid fa-person-dress" style="color: #33a7ff;"></i>$preference</h5>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-4" style="margin-left:100px; ">
                                <form method="POST" action="accept_tuition.php">
                <input type="hidden" name="TuitionID" value="$tuitionid">
                <button type="submit" class="btn btn-info buth1 accept-btn" style="background-color: rgb(43, 166, 18); margin-left:-60px; margin-top:10px;">Accept</button>
            </form>
                                </div>
                                <div class="col-sm-4">
                                <form action="delete_tuition.php" method="post">
                                        <input type="hidden" name="TuitionID" value="$tuitionid">
                                        <button type="submit" class="btn btn-info buth1 reject-btn" style="background-color: rgb(167, 7, 7); border: none; margin-left:-60px; margin-top:10px;">Reject</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
HTML;

                // Create a new row after every 2 columns
                if (($index + 1) % 2 == 0) {
                    echo '</div><div class="row">';
                }
                $index++;
            }
        } else {
            echo "<p class='centered-text'>No tuitions available.</p>";
        }
        ?>
    </div>
</div>


    <!-- OFFER SECTION ENDS -->

    <h2 id="pendingTutor" style="margin-left:600px; font-family: 'Bebas Neue', sans-serif;font-size: 45px;">Pending Tutor Profiles</h2>
    <?php
        $sqlS = "SELECT TutorID, Name, Email, PhoneNumber, Address, DOB, EdQual, DP FROM tutorprofile WHERE status = 'Pending'";
        $result = $conn->query($sqlS);

        if ($result->num_rows > 0) {
            echo "<div class='pending-tutor-container'>";
            
            // Fetch each row of the result
            while($rowS = $result->fetch_assoc()) {
                echo "<div class='pending-table'>";
                echo "<div><strong>TutorID:</strong> " . htmlspecialchars($rowS["TutorID"]) . "</div>";
                echo "<div><strong>Name:</strong> " . htmlspecialchars($rowS["Name"]) . "</div>";
                echo "<div><strong>Email:</strong> " . htmlspecialchars($rowS["Email"]) . "</div>";
                echo "<div><strong>Phone Number:</strong> " . htmlspecialchars($rowS["PhoneNumber"]) . "</div>";
                echo "<div><strong>Address:</strong> " . htmlspecialchars($rowS["Address"]) . "</div>";
                echo "<div><strong>DOB:</strong> " . date("d M, Y", strtotime($rowS["DOB"])) . "</div>";
                echo "<div><strong>Educational Qualification:</strong> " . htmlspecialchars($rowS["EdQual"]) . "</div>";
                // echo "<div><strong>DP:</strong> " . htmlspecialchars($rowS["DP"]) . "</div>";
                echo "<div class='actions'>
                        <form action='pending_action.php' method='post'>
                            <input type='hidden' name='TutorID' value='" . htmlspecialchars($rowS["TutorID"]) . "'>
                            <button type='submit' name='action' value='accept'>Accept</button>
                        </form>
                        <form action='pending_action.php' method='post'>
                            <input type='hidden' name='TutorID' value='" . htmlspecialchars($rowS["TutorID"]) . "'>
                            <button type='submit' name='action' value='reject'>Reject</button>
                        </form>
                      </div>";
                echo "</div>";
            }
        
            echo "</div>"; // Closing pending-tutor-container
        } else {
            echo "<p class='centered-text'>No pending tutors found.</p>";
        }
        
    ?>

<h2 id="pendingGuardian" style="margin-left:570px; font-family: 'Bebas Neue', sans-serif;font-size: 45px;">Pending Guardian Profiles</h2>
    <?php
        $sqlS = "SELECT GuardianID, Name, Email, PhoneNumber, Address, DOB FROM guardianprofile WHERE status = 'Pending'";
        $result = $conn->query($sqlS);

        if ($result->num_rows > 0) {
            echo "<div class='pending-tutor-container'>";
            
            // Fetch each row of the result
            while($rowS = $result->fetch_assoc()) {
                echo "<div class='pending-table'>";
                echo "<div><strong>GuardianID:</strong> " . htmlspecialchars($rowS["GuardianID"]) . "</div>";
                echo "<div><strong>Name:</strong> " . htmlspecialchars($rowS["Name"]) . "</div>";
                echo "<div><strong>Email:</strong> " . htmlspecialchars($rowS["Email"]) . "</div>";
                echo "<div><strong>Phone Number:</strong> " . htmlspecialchars($rowS["PhoneNumber"]) . "</div>";
                echo "<div><strong>Address:</strong> " . htmlspecialchars($rowS["Address"]) . "</div>";
                echo "<div><strong>DOB:</strong> " . date("d M, Y", strtotime($rowS["DOB"])) . "</div>";
                // echo "<div><strong>DP:</strong> " . htmlspecialchars($rowS["DP"]) . "</div>";
                echo "<div class='actions'>
                        <form action='pending_action.php' method='post'>
                            <input type='hidden' name='GuardianID' value='" . htmlspecialchars($rowS["GuardianID"]) . "'>
                            <button type='submit' name='action' value='accept'>Accept</button>
                        </form>
                        <form action='pending_action.php' method='post'>
                            <input type='hidden' name='GuardianID' value='" . htmlspecialchars($rowS["GuardianID"]) . "'>
                            <button type='submit' name='action' value='reject'>Reject</button>
                        </form>
                      </div>";
                echo "</div>";
            }
        
            echo "</div>"; // Closing pending-tutor-container
        } else {
            echo "<p class='centered-text'>No pending Guardian found.</p>";
        }
        
    ?>


     <!-- FOOTER -->
     <footer class="footer-distributed" id="about">

        <div class="footer-left">
            <img class="logo" src="images\logo.png" alt="TuitionEase" style=" width: 500px; margin-top: -60px; margin-left: -90px;"></img>

            <p class="footer-links" style="margin-top:-10px;">
                <a href="index.html">Home</a>
                |
                <a href="#tutor">Tutor Details</a>
                |
                <a href="#offers">Pending Offers</a>
                
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


    <!-- FOOTER ENDS -->



    <script src="admin.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d334581bb2.js" crossorigin="anonymous"></script>
</body>
</html>