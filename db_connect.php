<?php
function connect_to_database() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'pronote';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
