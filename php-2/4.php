<?php
$filename = __DIR__ . '/student.txt';
$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lines = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES) : [];
    switch ($_POST['action']) {
        case 'search':
            $term = trim($_POST['search'] ?? '');
            $matches = array_filter($lines, fn($l) => stripos($l, $term) !== false);
            if ($matches) {
                $output = "<h3>Search Results:</h3><ul>";
                foreach ($matches as $m) {
                    $output .= '<li>' . htmlspecialchars($m) . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output = '<p>No matching records found.</p>';
            }
            break;

        case 'update':
            $search = trim($_POST['search_update'] ?? '');
            $replace = trim($_POST['replace'] ?? '');
            $updated = false;
            foreach ($lines as &$line) {
                if (stripos($line, $search) !== false) {
                    $line = str_ireplace($search, $replace, $line);
                    $updated = true;
                }
            }
            unset($line);
            if ($updated) {
                file_put_contents($filename, implode(PHP_EOL, $lines) . PHP_EOL, LOCK_EX);
                $output = '<p>Records updated successfully.</p>';
            } else {
                $output = '<p>No records matched for update.</p>';
            }
            break;

        case 'delete':
            $term = trim($_POST['delete'] ?? '');
            $newLines = array_filter($lines, fn($l) => stripos($l, $term) === false);
            if (count($newLines) !== count($lines)) {
                file_put_contents($filename, implode(PHP_EOL, $newLines) . PHP_EOL, LOCK_EX);
                $output = '<p>Matching records deleted.</p>';
            } else {
                $output = '<p>No records matched for deletion.</p>';
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Student Records</title>
</head>
<body>
    <h1>Manage Student Records</h1>

    <?php echo $output; ?>

    <h2>Search Records</h2>
    <form method="post">
        <input type="hidden" name="action" value="search">
        <label>Keyword: <input type="text" name="search" required></label>
        <button type="submit">Search</button>
    </form>

    <h2>Update Records</h2>
    <form method="post">
        <input type="hidden" name="action" value="update">
        <label>Find: <input type="text" name="search_update" required></label><br>
        <label>Replace with: <input type="text" name="replace" required></label><br>
        <button type="submit">Update</button>
    </form>

    <h2>Delete Records</h2>
    <form method="post">
        <input type="hidden" name="action" value="delete">
        <label>Keyword: <input type="text" name="delete" required></label>
        <button type="submit">Delete</button>
    </form>
</body>
</html>