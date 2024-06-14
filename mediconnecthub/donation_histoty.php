<?php
include 'donation_conf.php';

// Ensure the 'id' parameter is set and is not empty
if(isset($_GET['don_id']) && !empty($_GET['don_id'])) {
    // Sanitize the 'id' parameter to prevent SQL injection
    $don_id = mysqli_real_escape_string($conn, $_GET['don_id']);

    // Query to select data for the specific donation ID in descending order of don_datetime
    $query = "SELECT * FROM donations WHERE don_id='$don_id' ORDER BY don_datetime DESC";
    $run = mysqli_query($conn, $query);

    // Check if there are any results
    if(mysqli_num_rows($run) > 0) {
        // Display the data in your table
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "<title>MediConnect Hub | Donation History</title>";
        echo "<link rel='stylesheet' type='text/css' href='scan.css'>";
        echo "<style>";
        echo "h1 { text-align: center; color: black; }";
        echo "td { color: black; background-color: lightblue; }";
        echo "th { color: black; }";
        echo ".button { background-image: linear-gradient( var(--deg, 90deg), hsl(201, 92%, 47%) 0%, hsl(225, 68%, 53%) 100%);
            color: white;
            text-transform: uppercase;
            padding: 10px 20px;
            text-align: center;
            border-radius: 4px;
            box-shadow: 0px 10px 30px hsla(225, 68%, 53%, 0.3; }";
        echo ".button:is(:hover, :focus) { --deg: -90deg; } }";
        echo "</style>";
        echo "</head>";
        echo "<br><br>";
        echo "<header><h1>Donations history</h1></header>";
        echo "<a href='scanned_view_details.php?id=$don_id'><button style='background-color: blue; color: white; padding: 10px 20px; margin: 0 0 0 215px;'>Back</button></a>";
        echo "<table border='1' cellspacing='0' cellpadding='0'>";
        echo "<tr class='heading'>";
        echo "<th>No</th>";
        echo "<th>Date&Time</th>";
        echo "<th>Donation ID</th>";
        echo "<th>Place</th>";
        echo "<th>Patient Name</th>";
        echo "</tr>";
        $i = 1;
        while($result = mysqli_fetch_assoc($run)) {
            echo "<tr class='data'>";
            echo "<td>".$i++."</td>";
            echo "<td>".$result['don_datetime']."</td>";
            echo "<td>".$result['don_donation_id']."</td>";
            echo "<td>".$result['don_place']."</td>";
            echo "<td>".$result['don_name']."</td>";
        }
        echo "</table>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No data found for this ID.";
    }
} else {
    echo "Donation ID not provided.";
}
?>
