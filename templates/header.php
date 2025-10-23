<?php
// Start session (if needed) and any initialisations
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Personal Expense Tracker</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="add_expense.php">Add Expense</a>
                <a href="view_expenses.php">View Expenses</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div style="text-align:right; margin-bottom:10px;">
                    Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> |
                    <a href="logout.php">Logout</a>
                </div>
            <?php endif; ?>

        </div>
    </header>
    <main class="container">