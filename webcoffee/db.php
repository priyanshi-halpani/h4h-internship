<?php

$host = "localhost";
$dbname = "coffee_shop";
$username = "user";
$password = "pass123";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>