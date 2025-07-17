<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM konsultasi WHERE user_id = $user_id ORDER BY tanggal DESC");

echo "<h2>Jadwal Konsultasi Saya</h2>";
echo "<table border='1'><tr><th>Topik</th><th>Tanggal</th><th>Status</th><th>Link</th><th>Lampiran</th><th>Invoice</th>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['topik']}</td>
            <td>{$row['tanggal']}</td>
            <td>{$row['status']}</td>
            <td>" . ($row['link_meet'] ?? '-') . "</td>
            <td>" . ($row['lampiran'] ? "<a href='uploads/{$row['lampiran']}'>Lihat</a>" : '-') . "</td>
          <th>Invoice</th></tr>";
}
echo "</table>";
echo "<a href='konsultasi.php'>Ajukan Lagi</a>";
?>