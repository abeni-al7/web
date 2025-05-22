<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['action']) {
        case 'create_cookie':
            setcookie($_POST['cookie_name'], $_POST['cookie_value'], time() + 3600);
            $message = "Cookie '{$_POST['cookie_name']}' created.";
            break;
        case 'read_cookie':
            $name = $_POST['cookie_name'];
            $value = $_COOKIE[$name] ?? 'Not set';
            $message = "Cookie '$name' value: $value";
            break;
        case 'delete_cookie':
            setcookie($_POST['cookie_name'], '', time() - 3600);
            $message = "Cookie '{$_POST['cookie_name']}' deleted.";
            break;

        case 'create_session':
            $_SESSION[$_POST['session_name']] = $_POST['session_value'];
            $message = "Session variable '{$_POST['session_name']}' created.";
            break;
        case 'read_session':
            $key = $_POST['session_name'];
            $val = $_SESSION[$key] ?? 'Not set';
            $message = "Session '$key': $val";
            break;
        case 'delete_session':
            unset($_SESSION[$_POST['session_name']]);
            $message = "Session variable '{$_POST['session_name']}' deleted.";
            break;
        case 'destroy_session':
            session_unset();
            session_destroy();
            $message = "Session destroyed.";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies and Sessions</title>
</head>
<body>
    <h1>Manage Cookies</h1>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="post">
        <input type="hidden" name="action" value="create_cookie">
        <label>Name: <input type="text" name="cookie_name" required></label>
        <label>Value: <input type="text" name="cookie_value" required></label>
        <button type="submit">Set Cookie</button>
    </form>
    <form method="post">
        <input type="hidden" name="action" value="read_cookie">
        <label>Name: <input type="text" name="cookie_name" required></label>
        <button type="submit">Read Cookie</button>
    </form>
    <form method="post">
        <input type="hidden" name="action" value="delete_cookie">
        <label>Name: <input type="text" name="cookie_name" required></label>
        <button type="submit">Delete Cookie</button>
    </form>

    <h1>Manage Sessions</h1>
    <form method="post">
        <input type="hidden" name="action" value="create_session">
        <label>Name: <input type="text" name="session_name" required></label>
        <label>Value: <input type="text" name="session_value" required></label>
        <button type="submit">Set Session</button>
    </form>
    <form method="post">
        <input type="hidden" name="action" value="read_session">
        <label>Name: <input type="text" name="session_name" required></label>
        <button type="submit">Read Session</button>
    </form>
    <form method="post">
        <input type="hidden" name="action" value="delete_session">
        <label>Name: <input type="text" name="session_name" required></label>
        <button type="submit">Delete Session Variable</button>
    </form>
    <form method="post">
        <input type="hidden" name="action" value="destroy_session">
        <button type="submit">Destroy Session</button>
    </form>
</body>
</html>