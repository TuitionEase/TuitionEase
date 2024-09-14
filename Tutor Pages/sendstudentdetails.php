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
        $result = $conn->query("SELECT COUNT(studentid) AS total FROM studentdetails");
        $row = $result->fetch_assoc();
        $studentid = $row['total'] + 1; 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Escape user inputs for security
            $name = $conn->real_escape_string($_POST['name']);
            $contact_number = $conn->real_escape_string($_POST['contact_number']);
            $class = $conn->real_escape_string($_POST['class']);
            $address = $conn->real_escape_string($_POST['address']);
            $subjects = $conn->real_escape_string($_POST['subjects']);
            $status = 'Running';
            // Example of inserting the data into the database
            $sql = "INSERT INTO studentdetails (studentid, tutorid, student_name, phone_number, class, address, subjects,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iissssss", $studentid, $tutorid, $name, $contact_number, $class, $address, $subjects,$status);
        
            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Student details submitted successfully.');</script>";
                echo "<script>window.location.href = 'studentdetails.php';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
        
            // Close the statement
            $stmt->close();
        }
        
        // Close database connection
        $conn->close();
?>
