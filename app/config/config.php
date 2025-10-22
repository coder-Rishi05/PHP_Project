<?php
$host = 'localhost';
$user = 'root';
$pass = 'root12'; // default for XAMPP/WAMP
$db   = 'expence_tracker';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
