<?php
session_start();
require_once __DIR__ . '/config.php';

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a> |
    <a href="add_student.php">Add Student</a> |
    <a href="list_students.php">List Students</a> |
    <a href="manage_student.php">Manage Student</a> |
    <a href="logout.php">Logout</a>
</nav>
<hr />
