<?php
require_once __DIR__ . '/includes/header.php';

check_login();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_no = trim($_POST['id_no']);
    $full_name = trim($_POST['full_name']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $age = (int)$_POST['age'];
    $department = trim($_POST['department']);
    $address = trim($_POST['address']);

    if ($id_no && $full_name && $gender && $dob && $age && $department) {
        $stmt = $conn->prepare(
            'INSERT INTO student (id_no, full_name, gender, dob, age, department, address) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('ssssiss', $id_no, $full_name, $gender, $dob, $age, $department, $address);
        if ($stmt->execute()) {
            $message = 'Student added successfully';
        } else {
            $message = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = 'Please fill all required fields';
    }
}
?>
<h2>Add Student</h2>
<p><?php echo $message; ?></p>
<form method="post">
    <label>ID No:<input type="text" name="id_no" required></label><br>
    <label>Full Name:<input type="text" name="full_name" required></label><br>
    <label>Gender:
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </label><br>
    <label>Date of Birth:<input type="date" name="dob" required></label><br>
    <label>Age:<input type="number" name="age" required></label><br>
    <label>Department:<input type="text" name="department" required></label><br>
    <label>Address:<textarea name="address"></textarea></label><br>
    <button type="submit">Add Student</button>
</form>
<?php require_once __DIR__ . '/includes/footer.php';?>
