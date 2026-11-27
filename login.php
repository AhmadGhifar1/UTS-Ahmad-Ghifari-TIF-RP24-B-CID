<?php
session_start();
require_once __DIR__ . '/koneksi.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT id, nama, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = ['id' => $user['id'], 'nama' => $user['nama'], 'username' => $user['username']];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | Outdoor Adventure</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/css/style.css" rel="stylesheet">
</head><body class="auth-bg">
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand fw-bold" href="index.php">Outdoor Adventure</a><a class="btn btn-outline-light btn-sm" href="index.php">Home</a></div></nav>
<main class="container auth-wrap">
  <div class="auth-card">
    <h2 class="fw-bold text-center">Login</h2><p class="text-secondary text-center">Masuk ke akun Outdoor Adventure.</p>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST" id="loginForm" novalidate>
      <div class="mb-3"><label class="form-label" for="username">Username</label><input class="form-control" type="text" id="username" name="username" required></div>
      <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" id="password" name="password" required></div>
      <button class="btn btn-success w-100" type="submit">Login</button>
    </form>
    <p class="text-center mt-3 mb-0">Belum punya akun? <a href="register.php">Registrasi</a></p>
  </div>
</main>
<footer class="site-footer"><div class="container text-center">©Copyright by 24552011296_Ahmad Ghifari_TIF RP 24 CID B</div></footer>
<script src="assets/js/script.js"></script>
</body></html>
