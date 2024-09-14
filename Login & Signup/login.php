<?php
session_start(); // Start the session
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

// Check if the login form is submitted
if (isset($_POST['email'], $_POST['pass'], $_POST['login_as'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $login_as = $_POST['login_as'];

    $_SESSION['email'] = $email;

    if ($login_as === 'tutor') {
        $stmt = $conn->prepare("SELECT Password FROM tutorprofile WHERE Email = ? AND Status = 'Accepted'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($own_password);
            $stmt->fetch();

            // Verify the password (consider using password_verify if passwords are hashed)
            if ($own_password == $password) {
                header("Location: welcome.php?email=$email");
                exit;
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email. Please try again.";
        }
    } elseif ($login_as === 'guardian') {
        $stmt = $conn->prepare("SELECT Password FROM guardianprofile WHERE Email = ? AND Status = 'Accepted'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($own_password);
            $stmt->fetch();

            // Verify the password (consider using password_verify if passwords are hashed)
            if ($own_password == $password) {
                header("Location: GuardianHome.php?email=$email");
                exit;
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email. Please try again.";
        }
    } elseif ($login_as === 'admin') {
        $stmt = $conn->prepare("SELECT Password FROM adminprofile WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($own_password);
            $stmt->fetch();

            // Verify the password (consider using password_verify if passwords are hashed)
            if ($own_password == $password) {
                header("Location: admin.php?email=$email");
                exit;
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email. Please try again.";
        }
    }
    exit;
}
?>
