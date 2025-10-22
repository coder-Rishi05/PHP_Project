<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="welcome">
    <h2>Welcome!</h2>
    <p>Track your expenses easily and stay on top of your budget.</p>
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>! Go ahead and <a href="add_expense.php">add an expense</a> or <a href="view_expenses.php">view your expenses</a>.</p>
    <?php else: ?>
        <p><a href="register.php">Register</a> or <a href="login.php">Login</a> to begin.</p>
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
