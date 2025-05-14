<?php
require_once __DIR__ . '/../config/Connection.php';

class Transaksi
{
    // Fungsi untuk mendapatkan koneksi database
    public static function db()
    {
        try {
            return Connection::getConnection();
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengambil semua transaksi
    public static function getAll()
    {
        $stmt = self::db()->prepare("SELECT id, pesanan_id, jumlah_bayar, tanggal FROM pembayaran ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Fungsi untuk mengambil transaksi berdasarkan ID
    public static function getById($id)
    {
        try {
            $stmt = self::db()->prepare("SELECT * FROM pembayaran WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data transaksi: " . $e->getMessage());
        }
    }

    // Fungsi untuk menambahkan transaksi pembayaran baru
    public static function create($data)
    {
        try {
            $stmt = self::db()->prepare("INSERT INTO pembayaran (pesanan_id, jumlah_bayar, tanggal) VALUES (?, ?, ?)");
            return $stmt->execute([
                $data['pesanan_id'],
                $data['jumlah_bayar'],
                $data['tanggal']
            ]);
        } catch (PDOException $e) {
            die("Error saat menambahkan pembayaran: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengupdate status pembayaran
    public static function update($data) {
    $stmt = self::db()->prepare("UPDATE pembayaran SET jumlah_bayar = ?, tanggal = ? WHERE id = ?");
    return $stmt->execute([$data['jumlah_bayar'], $data['tanggal'], $data['id']]);
    }

    public static function delete($id) {
    $stmt = self::db()->prepare("DELETE FROM pembayaran WHERE id = ?");
    return $stmt->execute([$id]);
    }
}
