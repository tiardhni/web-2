<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Koperasi Pegawai</title>

    <!-- SB Admin CSS -->
    <link href="/web-2-project/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <?php include 'partials/sidebar.php'; ?>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Manajemen Anggota</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="anggota/list-anggota.php">Lihat Anggota</a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Pengelolaan Data Produk</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="produk/list-produk.php">Lihat Produk</a>
                                    <div class="small text-white"><i class="fas fa-cogs"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Pemesanan</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="pemesanan/list-pemesanan.php">Lihat Pemesanan</a>
                                    <div class="small text-white"><i class="fas fa-cart-plus"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Transaksi Keuangan</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="transaksi/list-transaksi.php">Lihat Transaksi</a>
                                    <div class="small text-white"><i class="fas fa-money-bill-wave"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <!-- SB Admin Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/web-2-project/public/js/scripts.js"></script>
</body>

</html>