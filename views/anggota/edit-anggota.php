<?php
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';

// Validasi ID anggota
if (!isset($_GET['id'])) {
    header("Location: list-anggota.php");
    exit;
}

$anggotaId = (int)$_GET['id'];
$anggota = Anggota::getById($anggotaId);

if (!$anggota) {
    die('Anggota tidak ditemukan');
}

$pegawaiList = Pegawai::getAll();
$kartuDiskonList = KartuDiskon::getAll();

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'status_aktif' => isset($_POST['status_aktif']) ? (int)$_POST['status_aktif'] : 0,
        'pegawai_id' => (int)($_POST['pegawai_id'] ?? 0),
        'kartu_diskon_id' => $_POST['kartu_diskon_id'] !== '' ? (int)$_POST['kartu_diskon_id'] : null,
    ];

    Anggota::update($anggotaId, $data);
    header("Location: list-anggota.php");
    exit;
}

include_once __DIR__ . '/../partials/header.php';
?>

<body class="sb-nav-fixed">
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

<div id="layoutSidenav">
    <?php include_once __DIR__ . '/../partials/sidebar.php'; ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit Anggota</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list-anggota.php">Anggota</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-user-edit me-1"></i> Form Edit Anggota</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="status_aktif" class="form-label">Status Aktif</label>
                                <select id="status_aktif" name="status_aktif" class="form-select" required>
                                    <option value="1" <?= $anggota['status_aktif'] ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= !$anggota['status_aktif'] ? 'selected' : '' ?>>Non-Aktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pegawai_id" class="form-label">Pegawai</label>
                                <select id="pegawai_id" name="pegawai_id" class="form-select" required>
                                    <?php foreach ($pegawaiList as $pegawai): ?>
                                        <option value="<?= $pegawai['id'] ?>" <?= $anggota['pegawai_id'] == $pegawai['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pegawai['nama']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kartu_diskon_id" class="form-label">Kartu Diskon</label>
                                <select id="kartu_diskon_id" name="kartu_diskon_id" class="form-select">
                                    <option value="">-- Pilih Kartu Diskon --</option>
                                    <?php foreach ($kartuDiskonList as $kartuDiskon): ?>
                                        <option value="<?= $kartuDiskon['id'] ?>" <?= $anggota['kartu_diskon_id'] == $kartuDiskon['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kartuDiskon['nama']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <a href="list-anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
</div>

<script src="/web-2-project/public/js/scripts.js"></script>
</body>
</html>
