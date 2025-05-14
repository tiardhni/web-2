<?php
require_once '../../models/Transaksi.php';

// Validasi ID transaksi
if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}

// Proses penghapusan transaksi
if (Transaksi::delete($_GET['id'])) {
    header('Location: list-transaksi.php');
    exit;
} else {
    die("Gagal menghapus transaksi.");
}
?>
