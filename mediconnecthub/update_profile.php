<!-- update_profile.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['usr'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usr'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<body>
    <h2>Update Profile</h2>

    <form action="process_update_profile.php" method="post">
        <!-- Input fields for updating user information -->
        <label for="new_name">New Name:</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $user['bu_name']; ?>">
        <!-- Add more input fields for other information -->

        <input type="submit" value="Update Profile">
    </form>

</body>
</html>
