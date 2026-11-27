CREATE DATABASE IF NOT EXISTS outdoor_adventure
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE outdoor_adventure;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  kategori VARCHAR(60) NOT NULL,
  harga INT NOT NULL,
  gambar VARCHAR(500) DEFAULT '',
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produk (nama, kategori, harga, gambar, deskripsi) VALUES
('Tenda Camping', 'Camping', 150000,
 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=900&q=80',
 'Tenda untuk kegiatan berkemah bersama teman atau keluarga.'),
('Tas Carrier', 'Hiking', 50000,
 'https://images.unsplash.com/photo-1622260614153-03223fb72052?auto=format&fit=crop&w=900&q=80',
 'Tas carrier untuk membawa perlengkapan selama pendakian.'),
('Sepatu Hiking', 'Hiking', 40000,
 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80',
 'Sepatu untuk membantu aktivitas berjalan di jalur outdoor.'),
('Kompor Portable', 'Camping', 25000,
 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=900&q=80',
 'Kompor ringkas untuk memasak saat kegiatan camping.');

-- Akun dibuat melalui halaman Registrasi. Password disimpan dalam bentuk hash.
