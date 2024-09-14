<?php
// Check if TuitionID is set in POST data
if (isset($_POST['TuitionID'])) {
    // Sanitize input to prevent SQL injection
    $tuition_id = htmlspecialchars($_POST['TuitionID'], ENT_QUOTES, 'UTF-8');

    // Other validations if needed

    // Database connection parameters
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

    // Prepare SQL statement to update status to 'Accept'
    $sql = "UPDATE tuitions SET Status = 'Accepted' WHERE TuitionID = $tuition_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tuition status changed to Accept successfully');</script>";
    } else {
        echo "<script>alert('Error updating tuition status: " . $conn->error . "');</script>";
    }

    // Close connection
    $conn->close();
} else {
    echo "<script>alert('Tuition ID not provided');</script>";
}
?>
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
