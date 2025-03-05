<?php 

// Menerima value yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_customer = $_POST['nama_customer'];
    $pilih_produk = $_POST['pilih_produk'];
    $jumlah = $_POST['jumlah'];

    // LOGIKA MENGHITUNG TOTAL HARGA
    $harga_produk = 0;

    switch ($pilih_produk) { // Change $produk to $pilih_produk
        case 'TV':
            $harga_produk = 4200000; // Harga televisi
            break;
        case 'KULKAS':
            $harga_produk = 3100000; // Harga lemari
            break;
        case 'MESIN CUCI':
            $harga_produk = 3800000; // Harga mesin cuci
            break;
        default:
            echo "Produk tidak dikenali.";
            exit;
    }

    $total_harga = $harga_produk * $jumlah; // Change $jumlah_barang to $jumlah

    // Mencetak belanjaan
    echo "<h3>Detail Belanja</h3>";
    echo "Nama Pelanggan: " . htmlspecialchars($nama_customer) . "<br>";
    echo "Produk: " . htmlspecialchars($pilih_produk) . "<br>";
    echo "Jumlah Barang: " . htmlspecialchars($jumlah) . "<br>";
    echo "Total Harga: Rp " . number_format($total_harga, 0, ',', '.') . "<br>";
} else {
    echo "Tidak ada data yang dikirim.";
}
?>