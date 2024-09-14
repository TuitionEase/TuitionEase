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
        $result = $conn->query("SELECT COUNT(ResourceID) AS total FROM resource");
        $row = $result->fetch_assoc();
        $ResourceID = $row['total'] + 1; 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Escape user inputs for security
            $title = $conn->real_escape_string($_POST['title']);
            $type = $conn->real_escape_string($_POST['type']);
            
            // File upload handling
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
        
            // Check if file was uploaded without errors
            if ($fileError === 0) {
                $fileData = file_get_contents($fileTmpName); // Read the file content
                $fileType = mime_content_type($fileTmpName); // Get MIME type of the file
                // Prepare SQL statement to insert data into database (adjust table and column names as per your schema)
                $stmt = $conn->prepare("INSERT INTO resource (ResourceID, Name, Type, PDF, TutorID) VALUES (?, ?, ?, ?, ?)");
                $null = NULL;
                $stmt->bind_param("issbi", $ResourceID, $title, $type, $null, $tutorid);
                $stmt->send_long_data(3, $fileData);
                // Execute SQL statement
                if ($stmt->execute()) {
                    echo "<script>alert('File uploaded successfully.');</script>";
                    echo "<script>window.location.href = 'resource.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }
        
                // Close statement
                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        }
        
        // Close database connection
        $conn->close();
?>
