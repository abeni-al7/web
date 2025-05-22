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

// Query for year two students
$sql = "SELECT stud_id, firstname, lastname, year, dateofbirth, gpa FROM `Computer Science students` WHERE year = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Year Two Students:\n";
    echo "ID\tFirst Name\tLast Name\tYear\tDate of Birth\tGPA\n";
    while($row = $result->fetch_assoc()) {
        echo $row['stud_id'] . "\t" . $row['firstname'] . "\t" . $row['lastname'] . "\t" . $row['year'] . "\t" . $row['dateofbirth'] . "\t" . $row['gpa'] . "\n";
    }
} else {
    echo "No year two student records found.\n";
}

$conn->close();
?>