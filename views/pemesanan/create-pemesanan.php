<?php
require_once '../../models/Pemesanan.php';
require_once '../../models/Anggota.php';
require_once '../../models/Produk.php';

// Mengambil data anggota dan produk untuk dropdown
$anggotaList = Anggota::getAllWithNama(); // perbaikan di sini
$produkList = Produk::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'anggota_id' => $_POST['anggota_id'],
        'produk_id' => $_POST['produk_id'],
        'jumlah' => $_POST['jumlah'],
        'tanggal' => $_POST['tanggal'],
    ];

    if (Pemesanan::create($data)) {
        header('Location: list-pemesanan.php');
        exit;
    } else {
        $error = "Gagal menambahkan pemesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemesanan</title>
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
                    <h1 class="mt-4">Tambah Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="list-pemesanan.php">Pemesanan</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>

                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="anggota_id" class="form-label">Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="form-control" required>
                                <option value="">Pilih Anggota</option>
                                <?php foreach ($anggotaList as $anggota): ?>
                                    <option value="<?= $anggota['id']; ?>">
                                        <?= htmlspecialchars($anggota['nama_pegawai']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produk_id" class="form-label">Produk</label>
                            <select name="produk_id" id="produk_id" class="form-control" required>
                                <option value="">Pilih Produk</option>
                                <?php foreach ($produkList as $produk): ?>
                                    <option value="<?= $produk['id']; ?>">
                                        <?= htmlspecialchars($produk['nama']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pesan" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="list-pemesanan.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/web-2-project/public/js/scripts.js"></script>
</body>
</html>
