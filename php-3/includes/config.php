<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$pass = 'mypasstonewgen';
$db   = 'school';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}