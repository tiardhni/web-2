<?php
require_once '../../models/Pemesanan.php';

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus pemesanan berdasarkan ID
    if (Pemesanan::delete($id)) {
        header('Location: list-pemesanan.php');
        exit;
    } else {
        die("Gagal menghapus pemesanan.");
    }
} else {
    die("ID pemesanan tidak ditemukan.");
}
?>
