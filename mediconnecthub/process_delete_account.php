<!-- process_delete_account.php -->

<?php
session_start();
require 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['usr'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usr'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete the user account from the database (use prepared statements for security)
    Database::iud("DELETE FROM blood_user WHERE bu_id='" . $user['bu_id'] . "';");

    // Logout the user
    session_unset();
    session_destroy();

    // Redirect to a logged-out page or homepage
    header("Location: index.php");
    exit();
}
?>
