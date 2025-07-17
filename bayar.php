<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM konsultasi WHERE user_id = $user_id AND status = 'menunggu' ORDER BY tanggal DESC");

echo "<h2>Daftar Konsultasi yang Belum Dibayar</h2>";
echo "<table border='1'><tr><th>Topik</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['topik']}</td>
        <td>{$row['tanggal']}</td>
        <td>{$row['status']}</td>
        <td><a href='bayar_proses.php?id={$row['id']}'>Bayar</a></td>
    </tr>";
}
echo "</table>";
?>