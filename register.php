<?php
require_once __DIR__ . '/koneksi.php';
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi'] ?? '';

    if ($nama === '' || $username === '' || $password === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif ($password !== $konfirmasi) {
        $error = 'Konfirmasi password tidak sama.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $check->execute([$username]);
        if ($check->fetch()) {
            $error = 'Username sudah digunakan.';
        } else {
            $insert = $pdo->prepare("INSERT INTO users (nama, username, password) VALUES (?, ?, ?)");
            $insert->execute([$nama, $username, password_hash($password, PASSWORD_DEFAULT)]);
            $success = 'Registrasi berhasil. Silakan login.';
        }
    }
}
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrasi | Outdoor Adventure</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/css/style.css" rel="stylesheet">
</head><body class="auth-bg">
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand fw-bold" href="index.php">Outdoor Adventure</a><a class="btn btn-outline-light btn-sm" href="index.php">Home</a></div></nav>
<main class="container auth-wrap">
  <div class="auth-card">
    <h2 class="fw-bold text-center">Registrasi</h2><p class="text-secondary text-center">Buat akun baru.</p>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?> <a href="login.php">Login sekarang</a>.</div><?php endif; ?>
    <form method="POST">
      <div class="mb-3"><label class="form-label">Nama lengkap</label><input class="form-control" name="nama" required></div>
      <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
      <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" minlength="6" required></div>
      <div class="mb-3"><label class="form-label">Konfirmasi password</label><input class="form-control" type="password" name="konfirmasi" minlength="6" required></div>
      <button class="btn btn-success w-100" type="submit">Daftar</button>
    </form>
    <p class="text-center mt-3 mb-0">Sudah punya akun? <a href="login.php">Login</a></p>
  </div>
</main>
<footer class="site-footer"><div class="container text-center">©Copyright by 24552011296_Ahmad Ghifari_TIF RP 24 CID B</div></footer>
</body></html>
