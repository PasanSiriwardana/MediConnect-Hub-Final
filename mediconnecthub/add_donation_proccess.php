<?php

require 'connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $discribe_illness = $_POST['discribe_illness'];
    $describe_medicine = $_POST['describe_medicine'];

    Database::iud("INSERT INTO doc_report(id, doc_name, doc_age, doc_discribe_illness, doc_describe_medicine) 
    VALUES ('" . $id . "', '" . $name . "', '" . $age . "', '" . $discribe_illness . "', '" . $describe_medicine . "');");

    header("Location: scanned.php?id=$id");
    exit();
}

?>
