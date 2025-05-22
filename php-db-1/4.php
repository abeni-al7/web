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

// Update date of birth for student with stud_id 3
$newDob = '2000-01-01';
$sql = "UPDATE `Computer Science students` SET dateofbirth = '$newDob' WHERE stud_id = 3";

if ($conn->query($sql) === TRUE) {
    echo "Date of birth updated successfully for student ID 3.";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>