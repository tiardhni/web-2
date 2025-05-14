<?php
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../models/KartuDiskon.php'; // Pastikan model KartuDiskon dimasukkan

// Ambil daftar pegawai yang belum menjadi anggota
$pegawaiList = Anggota::getAvailablePegawai();

// Ambil daftar kartu diskon
$kartuDiskonList = KartuDiskon::getAll(); // Pastikan data kartu diskon ada

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pegawai_id = $_POST['pegawai_id'] ?? null;
    $kartu_diskon_id = $_POST['kartu_diskon_id'] ?? null;

    // Ambil data pegawai berdasarkan ID
    $pegawai = Pegawai::findById($pegawai_id);
    $nama = $pegawai['nama'] ?? '';

    $data = [
        'pegawai_id' => $pegawai_id,
        'nama' => $nama,
        'status_aktif' => isset($_POST['status_aktif']) ? 1 : 0,
        'kartu_diskon_id' => $kartu_diskon_id,
    ];

    // Tambahkan anggota
    Anggota::create($data);
    header("Location: list-anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

<div id="layoutSidenav">
    <?php include_once __DIR__ . '/../partials/sidebar.php'; ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah Anggota</h1>

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="pegawai_id" class="form-label">Pilih Pegawai</label>
                        <select name="pegawai_id" id="pegawai_id" class="form-control" required>
                            <option value="">-- Pilih Pegawai --</option>
                            <?php foreach ($pegawaiList as $pegawai): ?>
                                <option value="<?= $pegawai['id'] ?>">
                                    <?= htmlspecialchars($pegawai['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="status_aktif" id="status_aktif" checked>
                        <label class="form-check-label" for="status_aktif">Status Aktif</label>
                    </div>

                    <!-- Dropdown untuk memilih kartu diskon -->
                    <div class="mb-3">
                        <label for="kartu_diskon_id" class="form-label">Kartu Diskon</label>
                        <select name="kartu_diskon_id" id="kartu_diskon_id" class="form-control">
                            <option value="">-- Pilih Kartu Diskon --</option>
                            <?php foreach ($kartuDiskonList as $kartuDiskon): ?>
                                <option value="<?= $kartuDiskon['id'] ?>">
                                    <?= htmlspecialchars($kartuDiskon['nama']) ?> - <?= htmlspecialchars($kartuDiskon['persen_diskon']) ?>%
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="list-anggota.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </form>
            </div>
        </main>

        <?php include_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/web-2-project/public/js/scripts.js"></script>
</body>
</html>
