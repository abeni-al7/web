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

// Insert five student records
$sql = "INSERT INTO `Computer Science students` (firstname, lastname, year, dateofbirth, gpa) VALUES
('John', 'Doe', 3, '2002-05-14', 3.70),
('Jane', 'Smith', 2, '2003-08-21', 3.90),
('Alice', 'Johnson', 4, '2001-11-30', 3.80),
('Bob', 'Brown', 1, '2004-02-10', 3.20),
('Charlie', 'Davis', 3, '2002-07-25', 3.60)";

if ($conn->query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>