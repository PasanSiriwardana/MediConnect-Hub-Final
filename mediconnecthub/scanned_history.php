<?php
include 'conf.php';

// Ensure the 'id' parameter is set and is not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the 'id' parameter to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to select data for the specific page ID in descending order of datetime
    $query = "SELECT * FROM doc_report WHERE id='$id' ORDER BY datetime DESC";
    $run = mysqli_query($conn, $query);

    // Check if there are any results
    if(mysqli_num_rows($run) > 0) {
        // Display the data in your table
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "<title>Medical Reports</title>";
        echo "<link rel='stylesheet' type='text/css' href='scan.css'>";
        echo "<style>";
        echo "h1 { text-align: center; color: black; }";
        echo "td { color: black; }";
        echo "th { color: black; }";
        echo ".success { background-color: lightblue; }";
        echo ".pending { background-color: IndianRed; }";
        echo ".button { background-color: #9C3406;
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
        echo "<header><h1>Medical reports</h1></header>";
        echo "<br>";
        echo "<br>";
        $id = $_GET['id'];
        echo "<a href='scanned.php?id=$id'><button style='background-color: blue; color: white; padding: 10px 20px; margin: 0 0 0 215px;'>Back</button></a>";
        echo "<table border='1' cellspacing='0' cellpadding='0'>";
        echo "<tr class='heading'>";
        echo "<th>No</th>";
        echo "<th>Date&Time</th>";
        echo "<th>Patient Name</th>";
        echo "<th>Age</th>";
        echo "<th>Illness</th>";
        echo "<th>Medicine</th>";
        echo "<th>Confirmation</th>";
        echo "</tr>";
        $i = 1;
        while($result = mysqli_fetch_assoc($run)) {
            $row_class = $result['checked'] ? 'success' : 'pending';
            $button_display = $result['checked'] ? 'none' : 'inline-block';
            echo "<tr class='data $row_class'>";
            echo "<td>".$i++."</td>";
            echo "<td>".$result['datetime']."</td>";
            echo "<td>".$result['doc_name']."</td>";
            echo "<td>".$result['doc_age']."</td>";
            echo "<td>".$result['doc_discribe_illness']."</td>";
            echo "<td>".$result['doc_describe_medicine']."</td>";
            if ($result['checked'] == 0) {
                echo "<td><button class='button' onclick='updateCheckStatus(" . $result['no'] . ")' style='display: $button_display;'>Check</button></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</table>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No data found for this ID.";
    }
} else {
    echo "Page ID not provided.";
}
?>

<script>
function updateCheckStatus(no) {
    // Send an AJAX request to update the 'checked' status in the database
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_check_status.php?no=' + no, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Reload the page
            location.reload();
        } else {
            // Handle errors
            console.error('Error updating check status: ' + xhr.responseText);
        }
    };
    xhr.send();
}
</script>
