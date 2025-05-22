<?php
require_once __DIR__ . '/includes/header.php';

check_login();
?>
<h2>Welcome to Student Management System</h2>
<p>Select an option below:</p>
<ul>
    <li><a href="add_student.php">Add Student</a></li>
    <li><a href="list_students.php">List Students</a></li>
    <li><a href="manage_student.php">Manage Student</a></li>
</ul>
<?php
require_once __DIR__ . '/includes/footer.php';
?>
