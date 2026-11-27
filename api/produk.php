<?php
// Endpoint CRUD produk. Gunakan Postman untuk menguji GET, POST, PUT, dan DELETE.
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../koneksi.php';

function response($status, $data) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
            $stmt->execute([(int)$_GET['id']]);
            $item = $stmt->fetch();
            if (!$item) response(404, ['message' => 'Produk tidak ditemukan']);
            response(200, $item);
        }
        $items = $pdo->query("SELECT * FROM produk ORDER BY id ASC")->fetchAll();
        response(200, $items);
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input)) response(400, ['message' => 'Body harus berupa JSON yang valid']);

    if ($method === 'POST') {
        $nama = trim($input['nama'] ?? '');
        $kategori = trim($input['kategori'] ?? '');
        $harga = filter_var($input['harga'] ?? null, FILTER_VALIDATE_INT);
        $gambar = trim($input['gambar'] ?? '');
        $deskripsi = trim($input['deskripsi'] ?? '');

        if ($nama === '' || $kategori === '' || $harga === false || $harga === null || $harga < 0) {
            response(422, ['message' => 'nama, kategori, dan harga valid wajib diisi']);
        }
        $stmt = $pdo->prepare("INSERT INTO produk (nama, kategori, harga, gambar, deskripsi) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nama, $kategori, $harga, $gambar, $deskripsi]);
        response(201, ['message' => 'Produk berhasil ditambahkan', 'id' => (int)$pdo->lastInsertId()]);
    }

    if ($method === 'PUT') {
        $id = filter_var($input['id'] ?? null, FILTER_VALIDATE_INT);
        $nama = trim($input['nama'] ?? '');
        $kategori = trim($input['kategori'] ?? '');
        $harga = filter_var($input['harga'] ?? null, FILTER_VALIDATE_INT);
        $gambar = trim($input['gambar'] ?? '');
        $deskripsi = trim($input['deskripsi'] ?? '');

        if (!$id || $nama === '' || $kategori === '' || $harga === false || $harga === null || $harga < 0) {
            response(422, ['message' => 'id, nama, kategori, dan harga valid wajib diisi']);
        }
        $check = $pdo->prepare("SELECT id FROM produk WHERE id = ?");
        $check->execute([$id]);
        if (!$check->fetch()) response(404, ['message' => 'Produk tidak ditemukan']);

        $stmt = $pdo->prepare("UPDATE produk SET nama=?, kategori=?, harga=?, gambar=?, deskripsi=? WHERE id=?");
        $stmt->execute([$nama, $kategori, $harga, $gambar, $deskripsi, $id]);
        response(200, ['message' => 'Produk berhasil diperbarui']);
    }

    if ($method === 'DELETE') {
        $id = filter_var($input['id'] ?? null, FILTER_VALIDATE_INT);
        if (!$id) response(422, ['message' => 'id produk wajib diisi']);
        $stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        if ($stmt->rowCount() === 0) response(404, ['message' => 'Produk tidak ditemukan']);
        response(200, ['message' => 'Produk berhasil dihapus']);
    }

    header('Allow: GET, POST, PUT, DELETE');
    response(405, ['message' => 'Method tidak diizinkan']);
} catch (PDOException $e) {
    response(500, ['message' => 'Terjadi kesalahan database']);
}
