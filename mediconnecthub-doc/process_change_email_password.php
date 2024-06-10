<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redstream_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['usr'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usr'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get new email, password, and profile picture from the form
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];


    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE doc_user SET med_email=?, med_pass=? WHERE med_id=?");
    $stmt->bind_param("ssi", $new_email, $new_password, $user['med_id']);
    $stmt->execute();
    $stmt->close();    

    // Set a session variable for success message
    $_SESSION['success_message'] = 'Email, password, and profile picture changed successfully';

    // Redirect back to the profile page
    header("Location: my_details.php");
    exit();
}
?>
