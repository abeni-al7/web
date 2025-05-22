<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "mypasstonewgen";
$dbname = "Natural Science";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete student with stud_id 4
$sql = "DELETE FROM `Computer Science students` WHERE stud_id = 4";

if ($conn->query($sql) === TRUE) {
    echo "Student with ID 4 deleted successfully.";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>