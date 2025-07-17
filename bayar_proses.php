<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Simulasi pembayaran berhasil, update status jadi 'terjadwal'
$stmt = $conn->prepare("UPDATE konsultasi SET status='terjadwal' WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
if ($stmt->execute()) {
    echo "Pembayaran berhasil! Silakan tunggu jadwal dari admin.";
} else {
    echo "Gagal memproses pembayaran.";
}
echo "<br><a href='list_konsultasi.php'>Kembali ke Jadwal</a>";
?>