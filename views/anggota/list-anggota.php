<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
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
                    <h1 class="mt-4">Daftar Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Anggota</li>
                    </ol>

                    <!-- Konten list anggota -->
                    <?php
                    require_once '../../models/Anggota.php';
                    $anggotaList = Anggota::getAll();
                    ?>
                    <a href="create-anggota.php" class="btn btn-primary mb-3">Tambah Anggota</a>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th> <!-- Tambahkan kolom Nama -->
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anggotaList as $anggota): ?>
                                <tr>
                                    <td><?= $anggota['id']; ?></td>
                                    <td><?= htmlspecialchars($anggota['nama_pegawai']); ?></td> <!-- Nama tampil dulu -->
                                    <td><?= $anggota['status_aktif'] ? 'Aktif' : 'Tidak Aktif'; ?></td> <!-- Lalu status aktif -->
                                    <td>
                                        <a href="edit-anggota.php?id=<?= $anggota['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete-anggota.php?id=<?= $anggota['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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