<?php
require_once '../../models/Pemesanan.php';

// Ambil semua data pemesanan
$pemesananList = Pemesanan::getAll();

foreach ($pemesananList as $pemesanan) : ?>
    <tr>
        <td><?= $pemesanan['id']; ?></td>
        <td><?= $pemesanan['nama_anggota']; ?></td>
        <td><?= $pemesanan['nama_produk']; ?></td>
        <td><?= $pemesanan['jumlah']; ?></td>
        <td><?= $pemesanan['tanggal']; ?></td>
        <td>
            <a href="edit-pemesanan.php?id=<?= $pemesanan['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="delete-pemesanan.php?id=<?= $pemesanan['id']; ?>" class="btn btn-danger">Hapus</a>
        </td>
    </tr>
<?php endforeach; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List Pemesanan</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <?php include '../partials/navbar.php'; ?>

    <div id="layoutSidenav">
        <?php include '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">List Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pemesanan</li>
                    </ol>

                    <a href="create-pemesanan.php" class="btn btn-primary mb-3">Tambah Pemesanan</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pemesananList as $row): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nama_anggota']; ?></td>
                                    <td><?= $row['nama_produk'] ?? '-'; ?></td> <!-- Menampilkan produk, jika tidak ada, tampilkan tanda '-' -->
                                    <td><?= $row['jumlah']; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td>
                                        <a href="edit-pemesanan.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete-pemesanan.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>

            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/web-2-project/public/js/scripts.js"></script>
</body>

</html>
