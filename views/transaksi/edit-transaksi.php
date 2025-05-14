<?php
require_once '../../models/Transaksi.php';
require_once '../../models/Pemesanan.php';

// Validasi ID transaksi
if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}

$transaksi = Transaksi::getById($_GET['id']);
if (!$transaksi) {
    die("Transaksi tidak ditemukan.");
}

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi inputan kosong
    if (empty($_POST['jumlah_bayar']) || empty($_POST['tanggal_bayar'])) {
        $error = "Semua field harus diisi.";
    } else {
        $data = [
            'id' => $_GET['id'], // Menyertakan ID transaksi yang sedang diedit
            'jumlah_bayar' => $_POST['jumlah_bayar'],
            'tanggal' => $_POST['tanggal_bayar']
        ];

        // Simpan perubahan transaksi
        if (Transaksi::update($data)) {
            header('Location: list-transaksi.php');
            exit;
        } else {
            $error = "Gagal memperbarui transaksi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembayaran</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">

<?php include '../partials/navbar.php'; ?>
<div id="layoutSidenav">
    <?php include '../partials/sidebar.php'; ?>
    <div id="layoutSidenav_content">
        <main class="container-fluid px-4">
            <h2 class="mt-4">Edit Pembayaran</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="pesanan_id" class="form-label">ID Pesanan</label>
                    <input type="text" name="pesanan_id" class="form-control" value="<?= $transaksi['pesanan_id'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="form-control" value="<?= $transaksi['jumlah_bayar'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" class="form-control" value="<?= $transaksi['tanggal'] ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="list-transaksi.php" class="btn btn-secondary">Batal</a>
            </form>
        </main>
    </div>
</div>

<script src="/web-2-project/public/js/scripts.js"></script>
</body>
</html>
