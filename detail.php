<?php
require_once __DIR__ . '/koneksi.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id ?: 0]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Produk | Outdoor Adventure</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand fw-bold" href="index.php">Outdoor Adventure</a><a class="btn btn-outline-light btn-sm" href="index.php">Kembali ke Home</a></div></nav>
<main class="container py-5">
<?php if ($produk): ?>
  <div class="row g-4 align-items-center">
    <div class="col-md-6"><img class="detail-image" src="<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama']) ?>"></div>
    <div class="col-md-6">
      <span class="badge text-bg-success"><?= htmlspecialchars($produk['kategori']) ?></span>
      <h1 class="fw-bold mt-2"><?= htmlspecialchars($produk['nama']) ?></h1>
      <p class="text-secondary"><?= htmlspecialchars($produk['deskripsi']) ?></p>
      <h3 class="text-success">Rp<?= number_format((int)$produk['harga'], 0, ',', '.') ?> / hari</h3>
      <a href="login.php" class="btn btn-success mt-3">Login untuk Melanjutkan</a>
    </div>
  </div>
<?php else: ?>
  <div class="alert alert-warning">Produk tidak ditemukan. <a href="index.php">Kembali ke Home</a>.</div>
<?php endif; ?>
</main>
<footer class="site-footer"><div class="container text-center">©Copyright by 24552011296_Ahmad Ghifari_TIF RP 24 CID B</div></footer>
</body></html>
