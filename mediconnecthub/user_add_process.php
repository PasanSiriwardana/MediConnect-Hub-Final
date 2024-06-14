<?php

require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $age = $_POST['age'];
    $nic = $_POST['nic'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $donate_count = $_POST['donate_count'];
    $donate_date = $_POST['donate_date'];
    $like_to_donate = $_POST['like_to_donate'];
    $long_term_illness = $_POST['long_term_illness'];
    $discribe_illness = $_POST['discribe_illness'];
    $taking_any_medicine = $_POST['taking_any_medicine'];
    $discribe_medicine = $_POST['discribe_medicine'];
    $undergone_any_surgery = $_POST['undergone_any_surgery'];
    $discribe_surgery = $_POST['discribe_surgery'];

    $registration_time = date("Y-m-d H:i:s"); 

    Database::iud("INSERT INTO blood_user(bu_name, bu_age, bu_nic, bu_gender, bu_weight, bu_phone, bu_email, bu_pass, bu_blood_type, bu_city, bu_state, bu_donate_count, bu_donate_date, bu_like_to_donate, bu_long_term_illness, bu_discribe_illness, bu_taking_any_medicine, bu_discribe_medicine, bu_undergone_any_surgery, bu_discribe_surgery, registration_time) 
    VALUES ('" . $_POST['name'] . "', '" . $age . "', '" . $nic . "', '" . $gender . "', '" . $weight . "', '" . $_POST['phone'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "', '" . $_POST['blood_type'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $donate_count . "', '" . $donate_date . "', '" . $like_to_donate . "', '" . $long_term_illness . "', '" . $discribe_illness . "', '" . $taking_any_medicine . "', '" . $discribe_medicine . "', '" . $undergone_any_surgery . "', '" . $discribe_surgery . "', '" . $registration_time . "');");

    header("Location: login.php?message=success");
    exit();
}

?>
