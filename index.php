<?php
session_start();
require_once __DIR__ . '/koneksi.php';

$stmt = $pdo->query("SELECT id, nama, kategori, harga, gambar, deskripsi FROM produk ORDER BY id ASC");
$produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outdoor Adventure | Perlengkapan Outdoor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Outdoor Adventure</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navMenu">
      <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <a class="nav-link active" href="index.php">Home</a>
        <?php if (!empty($_SESSION['user'])): ?>
          <a class="nav-link" href="dashboard.php">Dashboard</a>
          <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="nav-link" href="login.php">Login</a>
          <a class="btn btn-success btn-sm" href="register.php">Registrasi</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<header class="hero">
  <div class="container py-5">
    <div class="row align-items-center min-vh-50">
      <div class="col-lg-7">
        <span class="badge text-bg-success mb-3">Jelajahi alam bersama kami</span>
        <h1 class="display-4 fw-bold text-white">Perlengkapan tepat untuk petualangan hebat.</h1>
        <p class="lead text-white-50 mt-3">Outdoor Adventure menyediakan perlengkapan camping dan hiking untuk menemani kegiatan luar ruangan Anda.</p>
        <a href="#produk" class="btn btn-success btn-lg mt-2">Lihat Produk</a>
      </div>
    </div>
  </div>
</header>

<main>
  <section class="container py-5">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-8">
        <h2 class="fw-bold">Tentang Outdoor Adventure</h2>
        <p class="text-secondary">Kami menyediakan layanan penyewaan perlengkapan outdoor yang praktis dan terjangkau. Pilih perlengkapan sesuai kebutuhan perjalanan Anda.</p>
      </div>
    </div>
    <div class="row g-3 text-center">
      <div class="col-md-4"><div class="info-box h-100"><h5>Perlengkapan Camping</h5><p class="mb-0 text-secondary">Tenda, kompor, dan perlengkapan berkemah.</p></div></div>
      <div class="col-md-4"><div class="info-box h-100"><h5>Perlengkapan Hiking</h5><p class="mb-0 text-secondary">Tas carrier dan sepatu untuk perjalanan.</p></div></div>
      <div class="col-md-4"><div class="info-box h-100"><h5>Harga Terjangkau</h5><p class="mb-0 text-secondary">Pilihan perlengkapan dengan harga sewa harian.</p></div></div>
    </div>
  </section>

  <section class="bg-light py-5" id="produk">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div><h2 class="fw-bold mb-1">Produk Pilihan</h2><p class="text-secondary mb-0">Pilih produk untuk melihat informasi lengkap.</p></div>
      </div>
      <div class="row g-4">
        <?php foreach ($produk as $item): ?>
          <div class="col-sm-6 col-lg-3">
            <div class="card product-card h-100">
              <img src="<?= htmlspecialchars($item['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['nama']) ?>">
              <div class="card-body d-flex flex-column">
                <span class="small text-success fw-semibold"><?= htmlspecialchars($item['kategori']) ?></span>
                <h5 class="card-title mt-1"><?= htmlspecialchars($item['nama']) ?></h5>
                <p class="text-secondary small flex-grow-1"><?= htmlspecialchars($item['deskripsi']) ?></p>
                <p class="fw-bold mb-3">Rp<?= number_format((int)$item['harga'], 0, ',', '.') ?> / hari</p>
                <a href="detail.php?id=<?= (int)$item['id'] ?>" class="btn btn-outline-success">Detail Informasi</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<footer class="site-footer"><div class="container text-center">©Copyright by 24552011296_Ahmad Ghifari_TIF RP 24 CID B</div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
