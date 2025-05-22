<?php
session_start();
require_once __DIR__ . '/includes/config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username && $password) {
        // Check if user exists
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = 'Username already taken';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $ins->bind_param('ss', $username, $hash);
            if ($ins->execute()) {
                header('Location: login.php');
                exit;
            } else {
                $message = 'Error creating account';
            }
        }
        $stmt->close();
    } else {
        $message = 'Please fill all fields';
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<h2>Sign Up</h2>
<p class="error"><?php echo $message; ?></p>
<form method="post">
    <label>Username:<input type="text" name="username" required></label>
    <label>Password:<input type="password" name="password" required></label>
    <button type="submit">Sign Up</button>
</form>
<p><a href="login.php">Login</a></p>
<?php require_once __DIR__ . '/includes/footer.php';
