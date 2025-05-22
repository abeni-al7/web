<?php
$username = '';
$email = '';
$dob = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate username
    $username = trim($_POST['username']);
    if (empty($username)) {
        $errors['username'] = 'Username is required.';
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        $errors['username'] = 'Username must be 3-20 characters long and can only contain letters, numbers, and underscores.';
    } else {
        $username = htmlspecialchars($username);
    }

    // Sanitize and validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    } else {
        $email = htmlspecialchars($email);
    }

    // Validate password
    $password = $_POST['password'];
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    // Validate confirm password
    $confirm_password = $_POST['confirm_password'];
    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'Confirm password is required.';
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    // Sanitize and validate date of birth
    $dob = trim($_POST['dob']);
    if (empty($dob)) {
        $errors['dob'] = 'Date of Birth is required.';
    } else {
        $date_parts = explode('-', $dob);
        if (count($date_parts) === 3 && checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
            $birthDate = new DateTime($dob);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
            if ($age < 5) {
                $errors['dob'] = 'Student must be at least 5 years old.';
            }
        } else {
            $errors['dob'] = 'Invalid Date of Birth format. Please use YYYY-MM-DD.';
        }
        $dob = htmlspecialchars($dob);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Registration</title>
  <style>
    .error { color: red; font-size: 0.9em; }
    label { display: block; margin-top: 10px; }
    input[type="text"], input[type="email"], input[type="password"], input[type="date"] {
        width: 250px;
        padding: 5px;
        margin-top: 5px;
    }
    button { margin-top: 15px; padding: 10px 15px; }
  </style>
</head>
<body>
  <h1>Student Registration Form</h1>

  <?php if (!empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
      <strong>Please correct the following errors:</strong>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if (empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST' && $username && $email && $dob): ?>
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 15px;">
      <h2>Registration Successful!</h2>
      <p>Hello, <?php echo $username; ?>!</p>
      <p>Your email: <?php echo $email; ?></p>
      <p>Your Date of Birth: <?php echo $dob; ?></p>
    </div>
  <?php else: ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
      <?php if (isset($errors['username'])): ?><span class="error"><?php echo $errors['username']; ?></span><?php endif; ?>
    </div>

    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
      <?php if (isset($errors['email'])): ?><span class="error"><?php echo $errors['email']; ?></span><?php endif; ?>
    </div>

    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <?php if (isset($errors['password'])): ?><span class="error"><?php echo $errors['password']; ?></span><?php endif; ?>
    </div>

    <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      <?php if (isset($errors['confirm_password'])): ?><span class="error"><?php echo $errors['confirm_password']; ?></span><?php endif; ?>
    </div>

    <div>
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
      <?php if (isset($errors['dob'])): ?><span class="error"><?php echo $errors['dob']; ?></span><?php endif; ?>
    </div>

    <button type="submit">Register</button>
  </form>
  <?php endif; ?>

</body>
</html>