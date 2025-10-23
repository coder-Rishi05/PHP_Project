<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all expenses
$stmt = $conn->prepare("SELECT title, amount, category, created_at FROM expenses WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// CSV file setup
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=expenses.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Title', 'Amount', 'Category', 'Date']);

while($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
