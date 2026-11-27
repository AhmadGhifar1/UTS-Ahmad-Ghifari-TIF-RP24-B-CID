<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/koneksi.php';
$produk = $pdo->query("SELECT id, nama, kategori, harga FROM produk ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | Outdoor Adventure</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/css/style.css" rel="stylesheet"></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container"><a class="navbar-brand fw-bold" href="index.php">Outdoor Adventure</a><div class="ms-auto d-flex gap-2"><a href="index.php" class="btn btn-outline-light btn-sm">Home</a><a href="logout.php" class="btn btn-success btn-sm">Logout</a></div></div></nav>
<main class="container py-5">
  <div class="p-4 p-md-5 rounded-4 dashboard-hero mb-4"><h1 class="fw-bold">Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</h1><p class="mb-0">Ini adalah halaman menu utama Outdoor Adventure.</p></div>
  <h3 class="fw-bold mb-3">Daftar Produk</h3>
  <div class="table-responsive"><table class="table table-striped table-bordered bg-white"><thead class="table-dark"><tr><th>ID</th><th>Nama Produk</th><th>Kategori</th><th>Harga Sewa / Hari</th><th>Detail</th></tr></thead><tbody>
  <?php foreach ($produk as $item): ?><tr><td><?= (int)$item['id'] ?></td><td><?= htmlspecialchars($item['nama']) ?></td><td><?= htmlspecialchars($item['kategori']) ?></td><td>Rp<?= number_format((int)$item['harga'], 0, ',', '.') ?></td><td><a href="detail.php?id=<?= (int)$item['id'] ?>" class="btn btn-sm btn-outline-success">Lihat</a></td></tr><?php endforeach; ?>
  </tbody></table></div>
</main>
<footer class="site-footer"><div class="container text-center">©Copyright by 24552011296_Ahmad Ghifari_TIF RP 24 CID B</div></footer>
</body></html>
