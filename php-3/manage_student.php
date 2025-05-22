<?php
require_once __DIR__ . '/includes/header.php';
check_login();

$message = '';
$student = null;

// Search by ID No
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $id_no = trim($_POST['id_no']);
        if ($id_no) {
            $stmt = $conn->prepare('SELECT * FROM student WHERE id_no = ?');
            $stmt->bind_param('s', $id_no);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();
            if (!$student) {
                $message = 'Student not found';
            }
            $stmt->close();
        }
    } elseif (isset($_POST['update'])) {
        $id_no = trim($_POST['id_no']);
        $full_name = trim($_POST['full_name']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $age = (int)$_POST['age'];
        $department = trim($_POST['department']);
        $address = trim($_POST['address']);

        $stmt = $conn->prepare(
            'UPDATE student SET full_name=?, gender=?, dob=?, age=?, department=?, address=? WHERE id_no=?'
        );
        $stmt->bind_param('sssisss', $full_name, $gender, $dob, $age, $department, $address, $id_no);
        if ($stmt->execute()) {
            $message = 'Student updated successfully';
        } else {
            $message = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $id_no = trim($_POST['id_no']);
        $stmt = $conn->prepare('DELETE FROM student WHERE id_no = ?');
        $stmt->bind_param('s', $id_no);
        if ($stmt->execute()) {
            $message = 'Student deleted successfully';
        } else {
            $message = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<h2>Manage Student</h2>
<p><?php echo $message; ?></p>
<!-- Search Form -->
<form method="post">
    <label>Enter Student ID No to Search:<input type="text" name="id_no" required></label>
    <button type="submit" name="search">Search</button>
</form>

<?php if ($student): ?>
<!-- Update/Delete Form -->
<form method="post">
    <input type="hidden" name="id_no" value="<?php echo htmlspecialchars($student['id_no']); ?>">
    <label>Full Name:<input type="text" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" required></label><br>
    <label>Gender:
        <select name="gender" required>
            <option value="Male" <?php if ($student['gender']=='Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($student['gender']=='Female') echo 'selected'; ?>>Female</option>
        </select>
    </label><br>
    <label>Date of Birth:<input type="date" name="dob" value="<?php echo $student['dob']; ?>" required></label><br>
    <label>Age:<input type="number" name="age" value="<?php echo $student['age']; ?>" required></label><br>
    <label>Department:<input type="text" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" required></label><br>
    <label>Address:<textarea name="address"><?php echo htmlspecialchars($student['address']); ?></textarea></label><br>
    <button type="submit" name="update">Update</button>
    <button type="submit" name="delete" onclick="return confirm('Are you sure?');">Delete</button>
</form>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
