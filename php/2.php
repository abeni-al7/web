<?php
$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Submit Name</title>
</head>
<body>
  <h1>Enter Your Name</h1>
  <form method="post" action="">
    <label for="username">Name:</label>
    <input type="text" id="username" name="username" required>
    <button type="submit">Submit</button>
  </form>

  <?php if ($username): ?>
    <h2>Hello, <?php echo $username; ?>!</h2>
  <?php endif; ?>
</body>
</html>