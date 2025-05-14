<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Navbar -->
    <?php include '../partials/navbar.php'; ?>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <?php include '../partials/sidebar.php'; ?>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Daftar Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>

                    <!-- Konten list produk -->
                    <?php
                    require_once '../../models/Produk.php';

                    // Mengambil data produk dan jenis produk dengan join
                    $sql = "SELECT p.*, j.nama AS jenis_nama FROM produk p
                            LEFT JOIN jenis_produk j ON p.jenis_produk_id = j.id";
                    $stmt = Connection::getConnection()->query($sql);
                    $produkList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <a href="create-produk.php" class="btn btn-primary mb-3">Tambah Produk</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jenis Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produkList as $produk): ?>
                            <tr>
                                <td><?= $produk['id']; ?></td>
                                <td><?= htmlspecialchars($produk['nama']); ?></td>
                                <!-- Menampilkan harga dengan 3 angka di belakang koma -->
                                <td><?= number_format($produk['harga'], 3, ',', '.'); ?></td>
                                <!-- Menampilkan nama jenis produk -->
                                <td><?= htmlspecialchars($produk['jenis_nama']); ?></td>
                                <td>
                                    <a href="edit-produk.php?id=<?= $produk['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete-produk.php?id=<?= $produk['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>

            <!-- Footer -->
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/web-2-project/public/js/scripts.js"></script>
</body>

</html>
