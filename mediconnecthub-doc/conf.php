<?php

class Database {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "redstream_db";
    private static $conn;

    // Establish database connection
    private static function connect() {
        self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }
    }

    // Close database connection
    private static function disconnect() {
        self::$conn->close();
    }

    // Execute Insert, Update, Delete (IUD) queries
    public static function iud($sql) {
        self::connect();
        $result = self::$conn->query($sql);
        self::disconnect();
        return $result === TRUE;
    }

    // Execute Select (search) queries
    public static function search($sql) {
        self::connect();
        $result = self::$conn->query($sql);
        self::disconnect();
        return $result;
    }

    // Execute Select (search) query and fetch a single row
    public static function searchSingle($sql) {
        self::connect();
        $result = self::$conn->query($sql);
        $row = $result->fetch_assoc();
        self::disconnect();
        return $row;
    }

    // Handle errors more gracefully
    public static function handleError($error_message) {
        // Log or display error message
        echo "Error: " . $error_message;
    }
}

?>
