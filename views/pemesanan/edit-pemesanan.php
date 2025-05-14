<?php
require_once '../../models/Pemesanan.php';
require_once '../../models/Anggota.php';
require_once '../../models/Produk.php';

// Cek apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    // Ambil data pemesanan berdasarkan ID
    $pemesanan = Pemesanan::getById($_GET['id']);
    if (!$pemesanan) {
        die("Pemesanan tidak ditemukan.");
    }
} else {
    die("ID pemesanan tidak ditemukan.");
}

// Ambil data anggota dan produk untuk dropdown
$anggotaList = Anggota::getAll();
$produkList = Produk::getAll();

// Ambil nama anggota dan produk berdasarkan ID
if (isset($pemesanan['anggota_id'])) {
    $anggota = Anggota::getById($pemesanan['anggota_id']); // Mengambil data anggota berdasarkan ID
} else {
    $anggota = null; // Jika anggota_id tidak ada, beri nilai null
}

if (isset($pemesanan['produk_id'])) {
    $produk = Produk::getById($pemesanan['produk_id']); // Mengambil data produk berdasarkan ID
} else {
    $produk = null; // Jika produk_id tidak ada, beri nilai null
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang baru dari form
    $data = [
        'anggota_id' => $_POST['anggota_id'],
        'produk_id' => $_POST['produk_id'],
        'jumlah' => $_POST['jumlah'],
        'tanggal' => $_POST['tanggal_pesan'] // sudah disesuaikan
    ];

    // Update pemesanan di database
    if (Pemesanan::update($_GET['id'], $data)) {
        header('Location: list-pemesanan.php');
        exit;
    } else {
        $error = "Gagal mengupdate pemesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Pemesanan</title>
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
                    <h1 class="mt-4">Edit Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit Pemesanan</li>
                    </ol>

                    <!-- Tampilkan error jika ada -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>

                    <form action="edit-pemesanan.php?id=<?= $pemesanan['id']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="anggota_id" class="form-label">Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="form-control">
                                <?php foreach ($anggotaList as $anggota): ?>
                                    <option value="<?= $anggota['id']; ?>" <?= ($pemesanan['anggota_id'] == $anggota['id']) ? 'selected' : ''; ?>>
                                        <?= $anggota['nama_pegawai']; ?>
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
                            <input type="date" name="tanggal_pesan" id="tanggal_pesan" class="form-control" value="<?= $pemesanan['tanggal']; ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Pemesanan</button>
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