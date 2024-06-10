<?php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'redstream_db';

// Create Database class
class Database {
    private static $connection = null;

    public static function connect() {
        global $db_host, $db_user, $db_pass, $db_name;

        if (self::$connection === null) {
            self::$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    public static function handleError($message) {
        // Handle errors
        die($message);
    }
}

// Check if the user is logged in
if (!isset($_SESSION['usr'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usr'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user information based on the submitted form data
    $new_name = $_POST['name'];
    $new_age = $_POST['age'];
    $new_phone = $_POST['phone'];
    $new_city = $_POST['city'];
    $new_state = $_POST['state'];
    $new_hospital_id = $_POST['hospital_id'];
    $new_special = $_POST['special'];
    $new_po_address = $_POST['po_address'];

    // Prepare the SQL statement
    $sql = "UPDATE doc_user SET med_name=?, med_age=?, med_phone=?, med_city=?, med_state=?, med_hospital_id=?, med_special=?, med_po_address=? WHERE med_id=?";
    $stmt = Database::connect()->prepare($sql);

    if (!$stmt) {
        Database::handleError("Failed to prepare statement: " . Database::connect()->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssi", $new_name, $new_age, $new_phone, $new_city, $new_state, $new_hospital_id, $new_special, $new_po_address, $user['med_id']);

    // Set parameters and execute
    $stmt->execute();

    // Check for success and redirect accordingly
    if ($stmt->affected_rows > 0) {
        // Set a session variable for success message
        $_SESSION['success_message'] = 'Profile updated successfully';
    } else {
        // Set a session variable for error message
        $_SESSION['error_message'] = 'Failed to update profile';
    }

    // Close the statement
    $stmt->close();

    // Redirect back to the profile page
    header("Location: logged.php?id=" . $user['med_id']);
    exit();
}
?>
