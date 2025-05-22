<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['id']);
    $department = htmlspecialchars($_POST['department']);
    $entry = "$name, $id, $department" . PHP_EOL;
    file_put_contents(__DIR__ . "/student.txt", $entry, FILE_APPEND | LOCK_EX);
    echo "<p>Student information saved successfully.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Entry Form</title>
</head>
<body>
    <h1>Enter Student Information</h1>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>