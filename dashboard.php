<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
echo "<h1>Selamat datang di Dashboard!</h1>";
echo "<p><a href='logout.php'>Logout</a></p>";
?>