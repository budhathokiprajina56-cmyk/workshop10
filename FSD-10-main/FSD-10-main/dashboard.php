<?php
require 'session.php';
require 'db.php';

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: login.php');
    exit;
}

$email = '';
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if ($user) $email = $user['email'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="Dashboard-container">
<h1 class="dashboard-h1">Welcome</h1>
<?php if ($email): ?>
    <p class="message">User: <?php echo htmlspecialchars($email); ?></p>
    <a href="?logout=1"><button>Logout</button></a>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>
</div>
</body>
</html>