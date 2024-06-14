
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MediConnect Hub</title>

  <!-- favicon-->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--css-->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    /* Form Styles */
    .form-title {
      color: var(--oxford-blue-1);
      font-family: var(--ff-poppins);
      font-size: 3.4rem;
      font-weight: var(--fw-800);
      text-align: center;
      margin-bottom: 20px;
    }

    .form-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .form-field {
      flex: 0 0 48%;
      margin-bottom: 20px;
    }

    .form-field label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-field input,
    .form-field select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-field input[type="submit"] {
      background-color: #216aca;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .form-field input[type="submit"]:hover {
      background-color: #060952;
    }
  </style>

</head>

<body id="top">

  <!-- HEADER-->
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
                    <a href="logged.php?id=<?php echo $user['bu_id']; ?>" class="navbar-link" data-nav-link>Profile</a>
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

  <main>
    <article>
      <section class="section service" id="service" aria-label="service">
        <div class="container">
          <br>
          <h2 class="h2 section-title text-center">Profile</h2>

          <form class="donor-form" action="process_update_profile.php" method="POST">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name"  value="<?php echo $user['bu_name']; ?>">
            </div>

            <div class="form-group">
              <label for="age">Age:</label>
              <input type="text" id="age" name="age" value="<?php echo $user['bu_age']; ?>"required>
            </div>

            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="tel" id="phone" name="phone" required oninput="formatPhoneNumber(this)" value="<?php echo $user['bu_phone']; ?>">
            </div>

            <div class="form-group">
              <label for="city">City:</label>
              <input type="text" id="city" name="city" value="<?php echo $user['bu_city']; ?>"required>
            </div>

            <div class="form-group">
              <label for="state">Province:</label>
              <select id="state" name="state">
                <option value="Central Province" <?php echo ($user['bu_state'] === 'Central Province') ? 'selected' : ''; ?>>Central Province</option>
                <option value="Eastern Province" <?php echo ($user['bu_state'] === 'Eastern Province') ? 'selected' : ''; ?>>Eastern Province</option>
                <option value="Northern Province" <?php echo ($user['bu_state'] === 'Northern Province') ? 'selected' : ''; ?>>Northern Province</option>
                <option value="North Central Province" <?php echo ($user['bu_state'] === 'North Central Province') ? 'selected' : ''; ?>>North Central Province</option>
                <option value="North Western Province" <?php echo ($user['bu_state'] === 'North Western Province') ? 'selected' : ''; ?>>North Western Province</option>
                <option value="Sabaragamuwa Province" <?php echo ($user['bu_state'] === 'Sabaragamuwa Province') ? 'selected' : ''; ?>>Sabaragamuwa Province</option>
                <option value="Southern Province" <?php echo ($user['bu_state'] === 'Southern Province') ? 'selected' : ''; ?>>Southern Province</option>
                <option value="Uva Province" <?php echo ($user['bu_state'] === 'Uva Province') ? 'selected' : ''; ?>>Uva Province</option>
                <option value="Western Province" <?php echo ($user['bu_state'] === 'Western Province') ? 'selected' : ''; ?>>Western Province</option>
              </select>
            </div>

            <div class="form-group">
              <label for="donate-count">Number of Times Donated:</label>
              <input type="text" id="donate_count" name="donate_count" value="<?php echo $user['bu_donate_count']; ?>"required>
            </div>

            <div class="form-group">
              <label for="lastdonate-date">Last Donated Date:</label>
              <input type="date" id="donate_date" name="donate_date" value="<?php echo $user['bu_donate_date']; ?>">
            </div>

            <div class="form-group">
              <label for="like-to-donate">I would like to Donate Blood:</label>
              <select id="like_to_donate" name="like_to_donate">
                <option value="Every 4 Months" <?php echo ($user['bu_like_to_donate'] === 'Every 4 Months') ? 'selected' : ''; ?>>Every 4 Months</option>
                <option value="Every 6 Months" <?php echo ($user['bu_like_to_donate'] === 'Every 6 Months') ? 'selected' : ''; ?>>Every 6 Months</option>
                <option value="Once a Year" <?php echo ($user['bu_like_to_donate'] === 'Once a Year') ? 'selected' : ''; ?>>Once a Year</option>
              </select>
            </div>

            <div class="form-group">
            <label for="long-term-illness">Are you suffering from any long term illness?:</label>
            <select id="long_term_illness" name="long_term_illness">
                <option value="Yes" <?php echo ($user['bu_long_term_illness'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo ($user['bu_long_term_illness'] === 'No') ? 'selected' : ''; ?>>No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="discribe-illness">Discribe the Illness:</label>
              <textarea id="discribe_illness" name="discribe_illness" rows="4" cols="79" value="<?php echo $user['bu_discribe_illness']; ?>"></textarea>
            </div>

            <div class="form-group">
            <label for="taking-any-medicine">Are you taking any medicine?:</label>
            <select id="taking_any_medicine" name="taking_any_medicine">
                <option value="Yes" <?php echo ($user['bu_taking_any_medicine'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo ($user['bu_taking_any_medicine'] === 'No') ? 'selected' : ''; ?>>No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="discribe-medicine">Discribe</label>
              <textarea id="discribe_medicine" name="discribe_medicine" rows="4" cols="79" value="<?php echo $user['bu_name']; ?>"></textarea>
            </div>

            <div class="form-group">
            <label for="undergone-any-surgery">Have you undergone any surgery?:</label>
            <select id="undergone_any_surgery" name="undergone_any_surgery" value="<?php echo $user['bu_name']; ?>">
                <option value="Yes" <?php echo ($user['bu_undergone_any_surgery'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo ($user['bu_undergone_any_surgery'] === 'No') ? 'selected' : ''; ?>>No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="discribe-surgery">Discribe</label>
              <textarea id="discribe_surgery" name="discribe_surgery" rows="4" cols="79" value="<?php echo $user['bu_name']; ?>"></textarea>
            </div>
            
            <button type="submit" class="btn">Update
            </button>
            <br>
            <center>
            <a href="change_email_password.php">Other changes</a>
            </center>
            
          </form>
        </div>
      </section>


  <!--FOOTER-->
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
            <a href="mailto:help@example.com" class="footer-link">contact@mediconnecthub.lk</a>
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
      <script>
        function formatPhoneNumber(input) {
            var phoneNumber = input.value.replace(/\D/g, '');
            if (!phoneNumber.startsWith('94')) {
                phoneNumber = '94' + phoneNumber;
            }
            var formattedPhoneNumber = '+' + phoneNumber.substr(0, 2) + ' ' + phoneNumber.substr(2);
            input.value = formattedPhoneNumber;
        }
    </script>

      
</body>

</html>