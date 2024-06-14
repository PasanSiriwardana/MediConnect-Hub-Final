<?php

class Database
{

    public static $connection;

    public static function setUpConnection()
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "", "redstream_db");

            // Check connection
            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q)
    {

        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q)
    {

        Database::setUpConnection();
        $resultset = null; // Define $resultset as null initially

        if (isset($_GET['id'])) {
            // Use prepared statement to avoid SQL injection
            $stmt = Database::$connection->prepare("SELECT * FROM blood_user WHERE bu_id=?");
            $stmt->bind_param("s", $_GET['id']);
            $stmt->execute();
            $resultset = $stmt->get_result();

            // Close the statement
            $stmt->close();
        } else {
            echo "ID parameter is missing in the URL.";
        }

        return $resultset; // Now $resultset is defined before being returned

    }
}
