<?php
$filename = __DIR__ . '/student.txt';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
</head>
<body>
    <h1>Student Records</h1>
    <?php
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (count($lines) > 0) {
            echo '<ul>';
            foreach ($lines as $line) {
                echo '<li>' . htmlspecialchars($line) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No student records found.</p>';
        }
    } else {
        echo '<p>No student records file available.</p>';
    }
    ?>
</body>
</html>