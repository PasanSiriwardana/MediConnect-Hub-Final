<?php

require 'conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $hospital_id = $_POST['hospital_id'];
    $special = $_POST['special'];
    $po_address = $_POST['po_address'];

    $registration_time = date("Y-m-d H:i:s"); 

    $sql = "INSERT INTO doc_user(med_name, med_age, med_gender, med_phone, med_email, med_pass, med_city, med_state, med_hospital_id, med_special, med_po_address, registration_time) 
    VALUES ('" . $_POST['name'] . "', '" . $age . "', '" . $gender . "', '" . $_POST['phone'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $hospital_id . "', '" . $special . "', '" . $po_address . "', '" . $registration_time . "');";

    if (Database::iud($sql)) {
        header("Location: logged.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

?>
