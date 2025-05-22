<?php
session_start();
require_once __DIR__ . '/includes/config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        header('Location: index.php');
        exit;
    } else {
        $message = 'Invalid credentials';
    }
    $stmt->close();
}
require_once __DIR__ . '/includes/header.php';
?>
<h2>Login</h2>
<p class="error"><?php echo $message; ?></p>
<form method="post">
    <label>Username:<input type="text" name="username" required></label>
    <label>Password:<input type="password" name="password" required></label>
    <button type="submit">Login</button>
</form>
<p><a href="signup.php">Sign Up</a></p>
<?php require_once __DIR__ . '/includes/footer.php';
