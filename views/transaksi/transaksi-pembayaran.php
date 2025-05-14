<?php
require_once '../../models/Transaksi.php';
require_once '../../models/Pemesanan.php';

$error = '';
$success = '';

// Validasi ID pemesanan
if (!isset($_GET['id'])) {
    die("ID pemesanan tidak ditemukan.");
}

$pemesanan = Pemesanan::getById($_GET['id']);
if (!$pemesanan) {
    die("Pemesanan tidak ditemukan.");
}

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi inputan kosong
    if (empty($_POST['jumlah_bayar']) || empty($_POST['tanggal_bayar'])) {
        $error = "Semua field harus diisi.";
    } else {
        $data = [
            'pesanan_id' => $_POST['pesanan_id'],
            'jumlah_bayar' => $_POST['jumlah_bayar'],
            'tanggal' => $_POST['tanggal_bayar'], // Menggunakan tanggal_bayar untuk tanggal pembayaran
        ];

        // Simpan ke database
        if (Transaksi::create($data)) {
            // Tidak perlu update status bayar
            header('Location: list-transaksi.php');
            exit;
        } else {
            $error = "Gagal menyimpan pembayaran.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembayaran</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">

<?php include '../partials/navbar.php'; ?>
<div id="layoutSidenav">
    <?php include '../partials/sidebar.php'; ?>
    <div id="layoutSidenav_content">
        <main class="container-fluid px-4">
            <h2 class="mt-4">Tambah Pembayaran</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="pesanan_id" class="form-label">ID Pesanan</label>
                    <input type="text" name="pesanan_id" class="form-control" value="<?= $pemesanan['id'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="list-transaksi.php" class="btn btn-secondary">Batal</a>
            </form>
        </main>
    </div>
</div>

<script src="/web-2-project/public/js/scripts.js"></script>
</body>
</html>
