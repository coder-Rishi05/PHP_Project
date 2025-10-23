<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: view_expenses.php");
    exit();
}

$message = '';

// Fetch current expense
$stmt = $conn->prepare("SELECT * FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$expense = $result->fetch_assoc();

if (!$expense) {
    die("Expense not found or access denied.");
}

// Handle update form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $amount = trim($_POST['amount']);
    $category = trim($_POST['category']);

    $stmt = $conn->prepare("UPDATE expenses SET title=?, amount=?, category=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sdsii", $title, $amount, $category, $id, $user_id);

    if ($stmt->execute()) {
        $message = "✅ Expense updated successfully!";
    } else {
        $message = "❌ Error updating expense.";
    }
}
?>

<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h2>Edit Expense</h2>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($expense['title']); ?>" required><br><br>

    <label>Amount:</label><br>
    <input type="number" step="0.01" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?php echo htmlspecialchars($expense['category']); ?>"><br><br>

    <button type="submit">Update Expense</button>
</form>

<p style="color:green;"><?php echo $message; ?></p>

<a href="view_expenses.php">⬅ Back to Expenses</a>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
