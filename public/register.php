<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $message = "Registration successful! You can now log in.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
require_once __DIR__ . '/../templates/header.php';
?>

<h2>Register</h2>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>
<p style="color:green;"><?php echo $message; ?></p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
