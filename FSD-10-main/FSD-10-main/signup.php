<?php
require 'db.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Invalid email");
        if (strlen($pass) < 8) throw new Exception("Password too short");

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, password_hash($pass, PASSWORD_DEFAULT)]);

        $msg = "User signed up successfully";
        header('refresh: 2; url=login.php');
    } catch (Exception $e) {
        $msg = "Signup failed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Signup</h2>
<?php if ($msg) echo "<p>$msg</p>"; ?>
<form method="POST">
    Email: <input type="text" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Signup</button>
</form>
<a href="login.php">Go to Login</a>
</body>
</html>