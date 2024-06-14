<?php
require 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediConnect Hub | My profile</title>
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
        /* svg {
        position: absolute;
        bottom: 0;
        top: 60%;
        left: 75%;
        transform: translateX(-50%);
        width: 100px;
        height: 100px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        z-index: 1;
    } */
/* @media only screen and (max-width: 569px) {
  svg {
    top: 50%;
  }
  .donor-form{
    top: 200px;
  }
} */
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
                    <a href="index.php#service" class="navbar-link" data-nav-link>Find donor</a>
                </li>
                <li>
                    <a href="about.html" class="navbar-link" data-nav-link>About Us</a>
                </li>
                <li>
                <a href="logout.php" class="navbar-link" data-nav-link>LOGOUT</a>
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
                        <p class="section-subtitle text-center">Find the best Donor For You</p>
                        <h2 class="h2 section-title text-center">FIND DONOR</h2>

                        <!-- Replace the existing content with your form -->

                        <?php
                    $rs = Database::search("SELECT * FROM blood_user WHERE bu_id='" . $_GET['id'] . "';");

                    $d = $rs->fetch_assoc();
                    ?>

                    <form class="donor-form">
                        <!-- Profile Picture -->
                        <center><div class="form-group">
                            <img src="data:image/jpeg;base64,<?= base64_encode($d['profile_picture']); ?>" alt="Profile Picture" style="width: 250px; border-radius: 5%;">
                        </div></center>
                        <center><svg style="align-item:right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <g id="qrcode"/>
                        </svg></center><br><br>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <?= $d['bu_name']; ?>
                            </div>

                            <div class="form-group">
                                <label for="name">Age:</label>
                                <?= $d['bu_age']; ?>
                            </div>

                            <div class="form-group">
                                <label for="name">NIC:</label>
                                <?= $d['bu_nic']; ?>
                            </div>

                            <div class="form-group">
                                <label for="name">Gender:</label>
                                <?= $d['bu_gender']; ?>
                            </div>

                            <div class="form-group">
                                <label for="name">Weight:</label>
                                <?= $d['bu_weight']; ?>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <h4><a href="tel:<?= $d['bu_phone']; ?>"><?= $d['bu_phone']; ?></a></h4>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <h4><a href="mailto:<?= $d['bu_email']; ?>"><?= $d['bu_email']; ?></a></h4>
                            </div>

                            <div class="form-group">
                                <label for="blood-type">Blood Type:</label>
                                <?= $d['bu_blood_type']; ?>
                            </div>

                            <div class="form-group">
                                <label for="city">City:</label>
                                <?= $d['bu_city']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">State:</label>
                                <?= $d['bu_state']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">Number of Times Donated:</label>
                                <?= $d['bu_donate_count']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">Last Donated Date:</label>
                                <?= $d['bu_donate_date']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">I Like to Donate blood to:</label>
                                <?= $d['bu_like_to_donate']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">i am suffering from any long term illness?:</label>
                                <?= $d['bu_long_term_illness']; ?><br>
                                <?= $d['bu_discribe_illness']; ?>
                            </div>

                            <div class="form-group">
                                <label for="state">Have i undergone any surgery?:</label>
                                <?= $d['bu_undergone_any_surgery']; ?><br>
                                <?= $d['bu_discribe_surgery']; ?>
                            </div>
                           
                            <div class="form-group">
                                <p>register date<p>
                                <?= $d['registration_time']; ?>
                            </div>


                            <!--   <button type="submit" class="btn">Find Donor</button> -->
                        </form>
                        <br>
                        <input id="text" type="text" value="http://localhost/mediconnecthub/scanned.php?id=<?= $d['bu_id']; ?>" style="width:80%;
                                                                                                      visibility:hidden;" />
                        <center><svg style="align-item:right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <g id="qrcode"/>
                        </svg></center>
                        <script type="text/javascript">
  var qrcode = new QRCode(document.getElementById("qrcode"), {
      width : 100,
      height : 100,
      useSVG: true
  });

  function makeCode () {		
      var elText = document.getElementById("text");

      if (!elText.value) {
          alert("Input a text");
          elText.focus();
          return;
      }

      qrcode.makeCode(elText.value);
  }

  makeCode();

  $("#text").
      on("blur", function () {
          makeCode();
      }).
      on("keydown", function (e) {
          if (e.keyCode == 13) {
              makeCode();
          }
      });
    </script>
                        <br><br><center>
                        <a class="btn btn-primary" href="index.php">Go Back</a>
                        <a class="btn btn-primary" href="my_details.php">Edit Profile</a></center>
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
            <a href="index.php#service" class="footer-link">
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