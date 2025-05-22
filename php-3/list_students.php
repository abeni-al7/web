<?php
require_once __DIR__ . '/includes/header.php';
check_login();

$message = '';
// Handle CSV upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];
    if (($handle = fopen($file, 'r')) !== false) {
        $stmt = $conn->prepare(
            'INSERT INTO student (id_no, full_name, gender, dob, age, department, address) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            list($id_no, $full_name, $gender, $dob, $age, $department, $address) = $data;
            $stmt->bind_param('ssssiss', $id_no, $full_name, $gender, $dob, $age, $department, $address);
            $stmt->execute();
        }
        $stmt->close();
        fclose($handle);
        $message = 'CSV data imported successfully';
    } else {
        $message = 'Error reading CSV file';
    }
}

// Fetch all students
$result = $conn->query('SELECT * FROM student');
?>
<h2>List Students</h2>
<p><?php echo $message; ?></p>
<form method="post" enctype="multipart/form-data">
    <label>Upload CSV:<input type="file" name="csv_file" accept=".csv" required></label>
    <button type="submit">Import</button>
</form>
<br>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>ID No</th><th>Full Name</th><th>Gender</th><th>DOB</th>
        <th>Age</th><th>Department</th><th>Address</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['id_no']); ?></td>
        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['dob']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo htmlspecialchars($row['department']); ?></td>
        <td><?php echo htmlspecialchars($row['address']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
