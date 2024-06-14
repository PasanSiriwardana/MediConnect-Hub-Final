<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediConnect Hub | Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- favicon-->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!--css-->
    <link rel="stylesheet" href="./assets/css/style.css">


    <!-- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .popup {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: linear-gradient(135deg, #ffffff, #a3d2ee);
            color: #0e254e;
            font-size: 16px;
            z-index: 9999;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
<header class="header">
<div class="header-top">
      <div class="container">
        <ul class="contact-list">
          <li class="contact-item">
            <ion-icon name="mail-outline"></ion-icon>
            <a href="mailto:contact@mediconnecthub.lk" class="contact-link">contact@mediconnecthub.lk</a>
          </li>
        </ul>
        <ul class="social-list">
          <li>
            <a href="https://www.facebook.com/" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>
          <li>
            <a href="https://twitter.com/" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>
          <li>
            <a href="https://youtu.be/" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="header-bottom" data-header>
      <div class="container">
      <a href="index.php" class="logo"><img src="assets/images/headerlogo.png" width="150cm" alt="logo"></a></a>
        <nav class="navbar container" data-navbar>
          <ul class="navbar-list">
            <li>
              <a href="index.php" class="navbar-link" data-nav-link>Home</a>
            </li>
            <li>
              <a href="index.php" class="navbar-link" data-nav-link>Find donor</a>
            </li>
            <li>
              <a href="about.html" class="navbar-link" data-nav-link>About Us</a>
            </li>
          </ul>
        </nav>
        <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
          <ion-icon name="menu-sharp" aria-hidden="true" class="menu-icon"></ion-icon>
          <ion-icon name="close-sharp" aria-hidden="true" class="close-icon"></ion-icon>
        </button>
      </div>
      <br>
    <hr style="width:100%;text-align:left;margin-left:0";>
    </div>
  </header>
  
    <div class="container"  style="margin-top: 40px;">
    
        <div class="row">
        
            <div class="col-12 mt-4">
            
              <br><br><br>
              
                <h2 class="h2 section-title text-center">Blood DONORS</h2>
                

<?php
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



// Check if all POST parameters are set
if (isset($_POST['blood_type']) && isset($_POST['city']) && isset($_POST['state'])) {
    // Escape user inputs for security
    $blood_type = $_POST['blood_type'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Construct the SQL query with placeholders to prevent SQL injection
    $sql = "SELECT * FROM blood_user 
            WHERE bu_blood_type LIKE ? AND bu_city LIKE ? AND bu_state LIKE ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("sss", $blood_type, $city, $state);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table id="resultTable" class="table table-striped">';
        echo '<thead><tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Phone</th>';
        echo '<th>Email</th>';
        echo '<th>Blood Type</th>';
        echo '<th>City</th>';
        echo '<th>Province</th>';
        echo '</tr></thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr class="table-row" onclick="page(' . $row['bu_id'] . ');">';
            echo '<td>' . $row['bu_id'] . '</td>';
            echo '<td>' . $row['bu_name'] . '</td>';
            echo '<td><p>+94*********</p></td>';
            echo '<td>' . $row['bu_email'] . '</td>';
            echo '<td>' . $row['bu_blood_type'] . '</td>';
            echo '<td>' . $row['bu_city'] . '</td>';
            echo '<td>' . $row['bu_state'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } 

      
       else {
            echo "<tr><td colspan='7'>No rows found</td></tr>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<tr><td colspan='7'>No search criteria provided</td></tr>";
    }
    ?>


                        <br>
                        <form action="profile_page.php" method="get">
                            <label for="">Find by id</label>
                            <input type="number" name="id" id="id" placeholder="ID">
                            <button class="btn" type="submit">Submit</button>
                        </form>


                        <br><br><br><br>
            </div>
            <div class="col-4 offset-4">
                <a class="btn btn-primary" href="index.php">Go back To Home</a>
            <br><br><br></div>
        </div>
    </div>



    <script>
        function page(id, blood_type, city, state) {
            window.location.href = 'profile_page.php?id=' + id;
        }
    </script>
<footer class="footer">
        <div class="footer-top section">
          <div class="container">
            <div class="footer-brand">
            <a href="index.php" class="logo"><img src="assets/images/headerlogo.png" width="170cm" alt="logo"></a></a>
              <p class="footer-text">
              Are you in need of blood or looking to make a life-saving donation in
              Sri Lanka? Our MediConnect Hub website is here to connect donors with those in need.
              </p>
              <div class="schedule">
                <div class="schedule-icon">
                  <ion-icon name="time-outline"></ion-icon>
                </div>
                <span class="span">
                  24 X 7:<br>
                  365 Days
                </span>
              </div>
            </div>
            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Other Links</p>
              </li>
              <li>
                <a href="index.php" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
                  <span class="span">Home</span>
                </a>
              </li>
              <li>
                <a href="index.php" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
                  <span class="span">Find donor</span>
                </a>
              </li>
              <li>
                <a href="about.html" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
                  <span class="span">About us</span>
                </a>
              </li>
              <li>
                <a href="login.php" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
                  <span class="span">Login</span>
                </a>
              </li>
              <li>
                <a href="register.php" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
                  <span class="span">Register</span>
                </a>
              </li>
            </ul>
            <ul class="footer-list">
              <li>
                <p class="footer-list-title"></p>
              </li>
              
            </ul>
            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Contact Us</p>
              </li>
              <li class="footer-item">
                <div class="item-icon">
                  <ion-icon name="location-outline"></ion-icon>
                </div>
                <a href="https://maps.app.goo.gl/u4kPKKQNZPPKajBp8">
                  <address class="item-text">
                    srilanka<br>
                  </address>
                </a>
              </li>
              <li class="footer-item">
                <div class="item-icon">
                  <ion-icon name="mail-outline"></ion-icon>
                </div>
                <a href="mailto:help@example.com" class="footer-link">contact@mediconnecthub.lk</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="container">
            <p class="copyright">
              &copy; 2024 All Rights Reserved by SwiftWind Ventures
            </p>
            <ul class="social-list">
              <li>
                <a href="https://www.facebook.com" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>
              <li>
                <a href="https://twitter.com" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
  <!--BACK TO TOP-->
  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="caret-up" aria-hidden="true"></ion-icon>
  </a>

  <!--custom js link-->
  <script src="./assets/js/script.js" defer></script>
  <!--ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>