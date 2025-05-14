<?php
require_once '../../models/Produk.php';
require_once '../../models/JenisProduk.php';

if (!isset($_GET['id'])) {
    header('Location: list-produk.php');
    exit;
}

$id = $_GET['id'];
$produk = Produk::getById($id);
$jenisProdukList = JenisProduk::getAll();

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'jenis_produk_id' => $_POST['jenis_produk_id']
    ];

    if (Produk::update($id, $data)) {
        header('Location: list-produk.php');
        exit;
    } else {
        $error = "Gagal memperbarui produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
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
                <h1 class="mt-4">Edit Produk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="list-produk.php">Produk</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($produk['nama']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="<?= $produk['harga']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                        <select name="jenis_produk_id" id="jenis_produk_id" class="form-control" required>
                            <?php foreach ($jenisProdukList as $jenis): ?>
                                <option value="<?= $jenis['id']; ?>" <?= $jenis['id'] == $produk['jenis_produk_id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($jenis['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="list-produk.php" class="btn btn-secondary">Batal</a>
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
