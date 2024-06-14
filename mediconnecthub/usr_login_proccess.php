<?php
session_start();

// Establishing database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "redstream_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT * FROM blood_user WHERE bu_email = ? AND bu_pass = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there is a row in the result
if ($result->num_rows > 0) {
    // Fetch the user data
    $user = $result->fetch_assoc();

    // Set session variable for the user
    $_SESSION['usr'] = $user;

    // Redirect to the logged.php page with id as query parameter
    header("Location: logged.php?id=" . urlencode($user['bu_id']));
} else {
    // Display an alert message in JavaScript
    echo '<script>alert("Entered email or password is incorrect");</script>';
    // Delay the redirect to login.php by 2 seconds
    echo '<script>setTimeout(function() { window.location.href = "login.php"; }, 100);</script>';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
