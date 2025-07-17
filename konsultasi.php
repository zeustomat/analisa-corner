<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topik = $_POST['topik'];
    $tanggal = $_POST['tanggal'];
    $user_id = $_SESSION['user_id'];

    $file_path = null;
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $ext = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $ext;
        $target = "uploads/" . $filename;
        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $target)) {
            $file_path = $filename;
        }
    }

    $stmt = $conn->prepare("INSERT INTO konsultasi (user_id, topik, tanggal, lampiran) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $topik, $tanggal, $file_path);

    if ($stmt->execute()) {
        echo "Pengajuan konsultasi berhasil.";
    } else {
        echo "Gagal mengajukan konsultasi: " . $stmt->error;
    }
}
?>

<h2>Form Pengajuan Konsultasi</h2>
<form method="post" enctype="multipart/form-data">
  <input type="text" name="topik" placeholder="Topik Konsultasi" required><br>
  <input type="datetime-local" name="tanggal" required><br>
  Lampiran (optional): <input type="file" name="lampiran"><br>
  <button type="submit">Ajukan Konsultasi</button>
</form>
<a href="list_konsultasi.php">Lihat Jadwal Saya</a>
