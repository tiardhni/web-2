<?php
require_once '../../models/Pemesanan.php';

$pesananBelumBayar = Pemesanan::getBelumBayar(); // Ambil pesanan status 0 (belum bayar)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilih Pesanan untuk Pembayaran</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include '../partials/navbar.php'; ?>

    <div id="layoutSidenav">
        <?php include '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pilih Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pilih Pesanan untuk Pembayaran</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Pesanan Belum Dibayar
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Anggota ID</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pesananBelumBayar as $p): ?>
                                        <tr>
                                            <td><?= $p['id']; ?></td>
                                            <td><?= $p['anggota_id']; ?></td>
                                            <td><?= $p['tanggal']; ?></td>
                                            <td>
                                                <a href="transaksi-pembayaran.php?id=<?= $p['id']; ?>" class="btn btn-sm btn-primary">Bayar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($pesananBelumBayar)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Semua pesanan sudah dibayar.</td>
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
</body>
</html>
