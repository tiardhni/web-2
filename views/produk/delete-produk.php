<?php
require_once '../../models/Produk.php';

if (!isset($_GET['id'])) {
    header('Location: list-produk.php');
    exit;
}

$id = $_GET['id'];

if (Produk::delete($id)) {
    header('Location: list-produk.php');
    exit;
} else {
    echo "Gagal menghapus produk.";
}
