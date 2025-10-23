<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Login successful — store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Remember Me cookie
            if (isset($_POST['remember_me'])) {
                // Cookie valid for 7 days
                setcookie("username", $user['username'], time() + (7*24*60*60), "/");
            } else {
                // Delete cookie if exists
                if (isset($_COOKIE['username'])) {
                    setcookie("username", "", time() - 3600, "/");
                }
            }

            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }
}

// Optional: Show cookie greeting if exists
$cookieMessage = '';
if (isset($_COOKIE['username'])) {
    $cookieMessage = "<p>Welcome back, " . htmlspecialchars($_COOKIE['username']) . "!</p>";
}

require_once __DIR__ . '/../templates/header.php';
?>

<h2>Login</h2>

<?php echo $cookieMessage; ?> <!-- Show cookie greeting -->

<form method="POST" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>
        <input type="checkbox" name="remember_me"> Remember Me
    </label><br><br>

    <button type="submit">Login</button>
</form>

<p style="color:red;"><?php echo $message; ?></p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
