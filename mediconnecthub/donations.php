<?php
// Include the database configuration file
require 'donation_conf.php';

// Define the Database class
class Database {
    public static function search($query) {
        global $conn; // Assuming $conn is your database connection variable

        // Perform the database query
        $result = $conn->query($query);

        if (!$result) {
            die('Error searching in the database: ' . $conn->error);
        }

        return $result;
    }
}

// Ensure the 'id' parameter is set and is not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the 'id' parameter to prevent SQL injection
    $id = $_GET['id'];

    // Query to select data for the specific bu_id
    $query = "SELECT * FROM blood_user WHERE bu_id='$id'";
    
    // Search in the database
    $rs = Database::search($query);

    // Check if there are any results
    if($rs->num_rows > 0) {
        // Fetch the data
        $d = $rs->fetch_assoc();
        // Use $d as needed
    } else {
        echo "No data found for this ID.";
    }
} else {
    echo "Page ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add your CSS and JS links here -->
</head>

<body>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        textarea {
          width: 600px;
    font-style: ;
    font-variant-ligatures: ;
    font-variant-caps: ;
    font-variant-numeric: ;
    font-variant-east-asian: ;
    font-variant-alternates: ;
    font-variant-position: ;
    font-weight: ;
    font-stretch: ;
    font-size: ;
    font-family: monospace;
    font-optical-sizing: ;
    font-kerning: ;
    font-feature-settings: ;
    font-variation-settings: ;
    text-rendering: auto;
    color: fieldtext;
    letter-spacing: normal;
    word-spacing: normal;
    line-height: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    appearance: auto;
    -webkit-rtl-ordering: logical;
    resize: -internal-textarea-auto;
    cursor: text;
    overflow-wrap: break-word;
    background-color: field;
    column-count: initial !important;
    margin: 0em;
    border-width: 1px;
    border-style: solid;
    border-color: light-dark(rgb(118, 118, 118), rgb(133, 133, 133));
    border-image: initial;
    padding: 2px;
    white-space: pre-wrap;
}
@media only screen and (max-width:775px) {
  textarea{
    width:500px;
  }
}
@media only screen and (max-width:603px) {
  textarea{
    width:400px;
  }
}
@media only screen and (max-width:440px) {
  textarea{
    width:350px;
  }
}
    </style>
        <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="qrcode.js"></script>
</head>

<body>
<header class="header">
    <div class="header-top">
      <div class="container">
        <ul class="contact-list">
          <li class="contact-item">
            <ion-icon name="mail-outline"></ion-icon>
            <a href="mailto:contact@mediconnect.lk" class="contact-link">contact@mediconnecthub.lk</a>
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
        <a href="index.php" class="logo"><img src="assets/images/headerlogo.png" width="150cm" alt="logo"></a>
        <nav class="navbar container" data-navbar>
            <ul class="navbar-list">
                <li>
                    <a href="index.php" class="navbar-link" data-nav-link>Home</a>
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
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <section class="section service" id="service" aria-label="service">
                    <div class="container">
                        <p class="section-subtitle text-center">Donation recorder</p>
                        <form class="donor-form" action="donation_add_proccess.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name"  value="<?php echo $d['bu_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="donation_id">Donation ID:</label>
                                <input type="text" id="donation_id" name="donation_id" required>
                            </div>
                            <div class="form-group">
                                <label for="place">Place:</label>
                                <input type="text" id="place" name="place" required>
                            </div>
                            <div style="visibility:hidden;" class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="id" name="id"  value="<?php echo $d['bu_id']; ?>" required>
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                        <br><br>
                        <a class="btn btn-primary" href="scanned.php?id=<?= $d['bu_id']; ?>">Go Back</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
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
            <a href="contact@mediconnecthub.lk" class="footer-link">contact@mediconnecthub.lk</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <a href="https://swiftwindrp.000webhostapp.com/"><p class="copyright">
          &copy; 2024 All Rights Reserved by SwiftWind Ventures
        </p></a>
        <ul class="social-list">
          <li>
            <a href="https://www.facebook.com/andro.pool.54?mibextid=ZbWKwL" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/_vladimir_putin.___/" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>
          <li>
            <a href="https://twitter.com/Annabel07785340" class="social-link">
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
  <script>
        function clickToCall() {
            var phoneNumber = document.getElementById('phoneNumber').value;
            if (phoneNumber) {
                window.location.href = 'tel:' + phoneNumber;
            } else {
                alert('Phone number not available.');
            }
        }
    </script>

</body>

</html>
