<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $amount = trim($_POST['amount']);
    $category = trim($_POST['category']);
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($amount)) {
        $stmt = $conn->prepare("INSERT INTO expenses (user_id, title, amount, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isds", $user_id, $title, $amount, $category);

        if ($stmt->execute()) {
            $message = "✅ Expense added successfully!";
        } else {
            $message = "❌ Error adding expense.";
        }
    } else {
        $message = "Please fill all required fields.";
    }
}
?>

<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h2>Add New Expense</h2>

<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Amount:</label><br>
    <input type="number" step="0.01" name="amount" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" placeholder="e.g., Food, Travel, Bills"><br><br>

    <button type="submit">Add Expense</button>
</form>

<p style="color:green;"><?php echo $message; ?></p>

<a href="index.php">⬅ Back to Home</a>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
