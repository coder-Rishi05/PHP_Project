<?php
// Start session (if needed) and any initializations
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <!-- Fixed CSS path -->
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Personal Expense Tracker</h1>
            
            <!-- Navigation -->
            <nav class="nav-bar">
                <a href="index.php">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="add_expense.php">Add Expense</a>
                    <a href="view_expenses.php">View Expenses</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>

            <!-- Greeting for logged-in user -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-greeting">
                    Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </div>
            <?php endif; ?>
        </div>
    </header>

    <main class="container">
