// Validasi login sisi browser menggunakan percabangan IF.
// Pemeriksaan akun sebenarnya tetap dilakukan oleh PHP dan database.
document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');

  if (loginForm) {
    loginForm.addEventListener('submit', function (event) {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value;

      if (username === '' && password === '') {
        event.preventDefault();
        alert('Username dan password wajib diisi.');
      } else if (username === '') {
        event.preventDefault();
        alert('Username wajib diisi.');
      } else if (password === '') {
        event.preventDefault();
        alert('Password wajib diisi.');
      }
      // Jika kedua kolom terisi, form dikirim ke login.php untuk diverifikasi.
    });
  }
});
