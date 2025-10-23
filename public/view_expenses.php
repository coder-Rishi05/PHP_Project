<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch expenses for the logged-in user
$stmt = $conn->prepare("SELECT * FROM expenses WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h2><?php echo htmlspecialchars($username); ?>'s Expenses</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Date</th>
        <th>Actions</th> <!-- 👈 Added column -->
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo number_format($row['amount'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit_expense.php?id=<?php echo $row['id']; ?>">✏ Edit</a> |
                <a href="delete_expense.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this expense?');">🗑 Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="add_expense.php">➕ Add Another Expense</a> |
<a href="index.php">🏠 Back to Home</a>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
