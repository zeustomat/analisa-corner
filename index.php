<?php
session_start();
$is_admin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Analisa Corner</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
    }
    header {
      background-color: #2c3e50;
      padding: 15px;
      color: white;
      text-align: center;
      font-size: 1.4rem;
    }
    .container {
      max-width: 900px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      border-radius: 12px;
    }
    .section {
      margin: 20px 0;
    }
    .section h2 {
      margin-bottom: 10px;
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }
    .card {
      background: #3498db;
      color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      font-size: 1.2rem;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    .footer {
      margin-top: 40px;
      text-align: center;
      font-size: 0.8rem;
      color: #999;
    }
    a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <header>
    👩‍⚖️ Analisa Corner - Dashboard
  </header>
  <div class="container">
    <div class="section">
      <h2>Selamat Datang di Sistem Konsultasi</h2>
      <div class="cards">
        <div class="card"><a href="blog/">📝 Blog Pribadi</a></div>
        <div class="card"><a href="konsultasi/">📅 Jadwal Konsultasi</a></div>
        <div class="card"><a href="login.php">🔐 Login User</a></div>
        <?php if ($is_admin): ?>
        <div class="card"><a href="admin/">🛠️ Panel Admin</a></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="footer">
      &copy; <?= date("Y") ?> Analisa Corner. All rights reserved.
    </div>
  </div>
</body>

</html>