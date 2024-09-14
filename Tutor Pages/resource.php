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
    <link rel="stylesheet" href="styleRes.css">
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

    <div class="box">
        <div class="left"><img src="images\res.png" alt=""></div>
        <div class="right">
        <h1 class="head">RESOURCE LIBRARY</h1>
        <p class="stu">Here you'll find all the resources teachers and tutors need, neatly organized </p>
        <p class="stu1">for easy access, including downloadable PDF files and more.</p>
        <p class="stu2"> for students' benefit</p>
    </div>
    </div>

    <div class="con">
        <div class="left"><img src="images\text.png" alt=""></div>
        <div class="right">
            <h2>Textbooks</h2>
            <p>Find downloadable textbooks of all classes in PDF format</p>
            <a href="textbooks.php" class="btn btn-primary">Go here</a>
        </div>
    </div>


    
    <div class="con1">
        <div class="left"><img src="images\qb.jpg" alt=""></div>
        <div class="right">
            <h2>Question Banks</h2>
            <p> Find downloadable question banks and test papers of all classes in PDF format</p>
            <a href="QB.php" class="btn btn-primary">Go here</a>
        </div>
    </div>
    <div class="con2">
        <div class="left"><img src="images\not.png" alt=""></div>
        <div class="right">
            <h2>Notes</h2>
            <p> Find downloadable notes of all classes in PDF format</p>
            <a href="notes.php" class="btn btn-primary">Go here</a>
        </div>
    </div>

    <div class="container">
    <h2>Add Resource</h2>
    <form action="./sendresource.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="">Select an option</option>
                <option value="Textbook">Textbook</option>
                <option value="Question Bank">Question Bank</option>
                <option value="Notes">Notes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>
    </div>

    


    <!-- SERVICES ENDS -->
    <script src="./afterlogin.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>