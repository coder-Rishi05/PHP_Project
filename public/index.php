<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch total expenses
$stmt = $conn->prepare("SELECT SUM(amount) AS total FROM expenses WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$totalResult = $stmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalExpenses = $totalRow['total'] ?? 0;

// Fetch last 5 expenses
$stmt = $conn->prepare("SELECT * FROM expenses WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$recentExpenses = $stmt->get_result();
?>

<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h2>Track your expenses easily and stay on top of your budget.</h2>
<p>Hello, <?php echo htmlspecialchars($username); ?>! Go ahead and add an expense or view your expenses.</p>

<h3>Total Expenses: ₹<?php echo number_format($totalExpenses, 2); ?></h3>

<h3>Recent 5 Expenses</h3>
<?php if ($recentExpenses->num_rows > 0): ?>
<table border="1" cellpadding="8">
    <tr>
        <th>Title</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Date</th>
    </tr>
    <?php while ($row = $recentExpenses->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td>₹<?php echo number_format($row['amount'], 2); ?></td>
        <td><?php echo htmlspecialchars($row['category']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
<p>No expenses yet. Add one now!</p>
<?php endif; ?>

<a href="add_expense.php">➕ Add Expense</a> |
<a href="view_expenses.php">📄 View All Expenses</a>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
