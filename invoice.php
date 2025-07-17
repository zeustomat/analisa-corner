<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT k.*, u.name, u.email FROM konsultasi k JOIN users u ON k.user_id = u.id WHERE k.id = $id AND k.user_id = $user_id");

if ($row = $result->fetch_assoc()) {
    echo "<h2>INVOICE KONSULTASI</h2>";
    echo "<hr>";
    echo "<p><b>Nama:</b> {$row['name']}<br>";
    echo "<b>Email:</b> {$row['email']}<br>";
    echo "<b>Topik:</b> {$row['topik']}<br>";
    echo "<b>Tanggal:</b> {$row['tanggal']}<br>";
    echo "<b>Status:</b> {$row['status']}<br>";
    echo "<b>Link Meeting:</b> " . ($row['link_meet'] ?? '-') . "<br>";
    echo "<b>Tanggal Invoice:</b> " . date('Y-m-d H:i:s') . "</p>";
    echo "<hr>";
    echo "<p><b>Total:</b> Rp250.000,-</p>";
    echo "<button onclick='window.print()'>Cetak Invoice</button>";
} else {
    echo "Invoice tidak ditemukan atau Anda tidak memiliki akses.";
}
?>