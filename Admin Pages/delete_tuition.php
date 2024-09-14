<?php
// Check if tuition_id is set in POST data
// Check if tuition_id is set in POST data
if (isset($_POST['TuitionID'])) {
    // Sanitize input to prevent SQL injection
    $tuition_id = htmlspecialchars($_POST['TuitionID'], ENT_QUOTES, 'UTF-8');

    // Perform database operations to delete the tuition with the specified ID
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

    // Use prepared statements to avoid SQL injection
    $sql = "UPDATE tuitions SET Status = 'Rejected' WHERE TuitionID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tuition_id);

    if ($stmt->execute()) {
        echo "<script>alert('Tuition deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting tuition: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Tuition ID not provided');</script>";
}

?>
<?php
        session_start();


        $servername = "localhost";
        $username = "root"; // Default XAMPP username
        $password = "Hello_there12"; // Default XAMPP password (empty)
        // Default XAMPP password (empty)
        $dbname = "tuitionease"; // Change to your database name
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

        $sql = "SELECT TutorID, Name, Email, PhoneNumber, Address, Gender, DOB, EdQual, FBID FROM tutorprofile";
        $result = $conn->query($sql);
        $result2 = $conn->query("SELECT COUNT(TutorID) AS total FROM tutorprofile");
        $row = $result2->fetch_assoc();
        $tuitionCount = $row['total'];

        $sqlG = "SELECT GuardianID,  Name, Email, PhoneNumber, Address, Gender, DOB FROM guardianprofile";
        $resultG = $conn->query($sqlG);
        $result2G = $conn->query("SELECT COUNT(GuardianID) AS totalG FROM guardianprofile");
        $rowG = $result2G->fetch_assoc();
        $tuitionCountG = $rowG['totalG'];
        header("Location: admin.php#offers");
?>
