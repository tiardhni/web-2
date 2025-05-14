<?php
require_once '../../models/Transaksi.php';
require_once '../../models/Pemesanan.php';

// Ambil semua transaksi
$transaksi = Transaksi::getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">

    <?php include '../partials/navbar.php'; ?>

    <div id="layoutSidenav">
        <?php include '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Daftar Transaksi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>

                    <!-- Tampilkan tombol tambah pembayaran hanya sekali -->
                    <a href="pilih-pesanan.php" class="btn btn-primary mb-3">+ Tambah Pembayaran</a>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Transaksi Pembayaran
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Pesanan</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Tanggal Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $t): ?>
                                        <tr>
                                            <td><?= $t['id']; ?></td>
                                            <td><?= $t['pesanan_id']; ?></td>
                                            <td>Rp<?= number_format($t['jumlah_bayar'], 0, ',', '.'); ?></td>
                                            <td><?= $t['tanggal']; ?></td>
                                            <td>
                                                <a href="edit-transaksi.php?id=<?= $t['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="delete-transaksi.php?id=<?= $t['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($transaksi)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada transaksi.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="/web-2-project/public/js/scripts.js"></script>
</body>

</html>